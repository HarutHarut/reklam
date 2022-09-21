<?php

namespace App\Services;

use App\Models\Filter;
use App\Models\FilterMaliOglasi;
use App\Models\FiltersOption;
use App\Models\Kategorije;
use App\Models\MaliOglasi;
use Carbon\Carbon;
use Psy\Input\FilterOptions;

/**
 * Class FilterServices
 * @package App\Services
 */
class FilterServices
{
    public function __construct()
    {
        //
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public static function productFilters($query, $data)
    {
        if (isset($data['regions']) && $data['regions'] !== '[]') {
            if (!is_array($data['regions'])) {
                $data['regions'] = json_decode($data['regions']);
            }
            if (count($data['regions'])) {
                $query = $query->where(function ($q) use ($data) {
                    $q
                        ->whereIn('regija_id', $data['regions'])
                        ->orWhereHas('regije', function ($q) use ($data) {
                            $q->whereIn('parent_id', $data['regions']);
                        });
                });
            }
        }

        if (isset($data['productType']) && $data['productType'] !== '[]') {
            if (!is_array($data['productType'])) {
                $data['productType'] = json_decode($data['productType']);
            }
            if (count($data['productType'])) {
                $query = $query->whereIn('tip_oglasa', $data['productType']);
            }
        }

        if (isset($data['searchQuery']) && $data['searchQuery'] !== '' && $data['searchQuery'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('naslov', 'LIKE', '%' . $data['searchQuery'] . '%')
                    ->orWhere('opis', 'LIKE', '%' . $data['searchQuery'] . '%');
            });
        }


        if (isset($data['priceRange']) && $data['priceRange'] !== null && $data['priceRange'] !== '[]' && $data['priceRange'] !== 'undefined') {
            list($min, $max) = explode(";", $data['priceRange']);
            $query = $query->where('cena', '>=', $min)
                ->where('cena', '<=', $max);
        }

        if (isset($data['custom_filters']) && $data['custom_filters'] !== null && $data['custom_filters'] !== '[]' && $data['custom_filters'] !== '{}' && count($data['custom_filters'])) {
            $filterIds = [];
            $optionIds = [];
            $rangeOptionIds = [];
            foreach ($data['custom_filters'] as $filterId => $items) {
                $filter = Filter::find($filterId);
                if ($filter->tip !== 2) {
                    foreach ($items as $option) {
                        $optionIds[] = $option;
                    }
                } else {
                    list($minFilter, $maxFilter) = explode(";", $items);
                    if ($minFilter > 0 || $maxFilter < 100) {
                        $temp = FiltersOption::select('id')->wherehas('filter', function ($q) {
                            $q->where('tip', 2);
                        })
                            ->where('option', '>=', (int)$minFilter)
                            ->where('option', '<=', (int)$maxFilter)->pluck('id')->toArray();
//                    $temp = array_column($temp, 'id');
                        $rangeOptionIds = array_merge($rangeOptionIds, $temp);
                    }
                }
                $filterIds[] = $filterId;
            }

            $allOptionIds = array_merge($rangeOptionIds, $optionIds);
            $filterMaliOglasi = FilterMaliOglasi::whereIn('f_o_id', $allOptionIds)->pluck('listing_id')->toArray();

            if (count($filterMaliOglasi)) {
                $query = $query->whereIn('id', $filterMaliOglasi);
            }
        }

        if (isset($data['category']) && $data['category'] !== null) {
            $category = Kategorije::where('slug', $data['category'])->first();

            $query = $query->whereHas($category->parent_id ? 'kategorijeTip1' : 'kategorijeTip0', function ($q) use ($data) {
                $q->where('slug', $data['category']);
            });
        }

        if (isset($data['customer_id']) && $data['customer_id'] !== null && $data['customer_id'] !== '[]') {
            $query = $query->where('user_id', $data['customer_id']);
        }

        if (isset($data['sortType']) && $data['sortType'] !== null) {
            if ($data['sortType'] == 'cena') {
                $query = $query->orderBy('cena', 'desc');
            } elseif ($data['sortType'] == 'datum_vnosa') {
                $query = $query->orderBy('datum_vnosa', 'desc');
            }
        } else {
            $query = $query->orderBy('date_sort', 'desc');
        }

        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function userProductFilters($query, $data)
    {
        $newData = [];
        $listingStatus = '';
        if (isset($data) && $data == 'active') {
            $query = $query->where('status', 1);
            $listingStatus = 'active';
        }
        if (isset($data) && $data == 'inactive') {
            $query = $query->where('status', 0)->orWhere('status', 3);
            $listingStatus = 'inactive';
        }
        if (isset($data) && $data == 'expired') {
            $query = $query->where('datum_poteka', '<=', Carbon::now());
            $listingStatus = 'expired';
        }

        $newData['query'] = $query;
        $newData['listingStatus'] = $listingStatus;

        return $newData;
    }

    /**
     * @param $category
     * @return |null |null |null
     */
    public static function categoryAlphaParent($category)
    {
        if (isset($category) && $category !== null) {
            while ($category->parent_id !== null) {
                $category = Kategorije::where('id', $category->parent_id)->first();
            }
        }

        return $category;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public static function companyFilter($query, $data)
    {
        if (isset($data['searchCompany']) && $data['searchCompany'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('tocen_naziv', 'like', '%' . $data['searchCompany'] . '%')
                    ->orWhere('trgovina_opis', 'LIKE', '%' . $data['searchCompany'] . '%');
            });
        }

        if(isset($data['category_id']) && $data['category_id'] !== null){
            $query = $query->where('category_id', $data['category_id']);
        }
        return $query;
    }

    /**
     * @param $id
     */
    public static function deleteFilter($id)
    {
        $filterMaliOglasi = FilterMaliOglasi::where('f_id', $id)->get();
        $filtersOption = FiltersOption::where('f_id', $id)->get();

        foreach ($filterMaliOglasi as $item){
            $item->delete();
        }
        foreach ($filtersOption as $item){
            $item->delete();
        }

        Filter::destroy($id);
    }
}
