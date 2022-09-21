<?php

namespace App\Services;

use App\Models\Kategorije;

/**
 * Class DashboardServices
 * @package App\Services
 */
class DashboardServices
{
    public static function productFilters($query, $data)
    {
        if (isset($data['search']) && $data['search'] !== '' && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('naslov', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('opis', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('id', $data['search'])
                    ->orWhereHas('customer.user', function ($q) use($data) {
                        $q->where('name', 'LIKE', '%' . $data['search']. '%');
                    })
                    ->orWhereHas('kategorijeTip1', function ($q) use($data) {
                        $q->where('tip', 'LIKE', '%' . $data['search']. '%');
                    });
            });
        }

        if (isset($data['parent_category_id']) && $data['parent_category_id'] !== null) {
            $category = Kategorije::where('id', $data['parent_category_id'])->first();

            $query = $query->whereHas($category->parent_id ? 'kategorijeTip1' : 'kategorijeTip0', function ($q) use ($data) {
                $q->where('id', $data['parent_category_id']);
            });
        }

        if (isset($data['child_category_id']) && $data['child_category_id'] !== null) {
            $category = Kategorije::where('id', $data['child_category_id'])->first();

            $query = $query->whereHas($category->parent_id ? 'kategorijeTip1' : 'kategorijeTip0', function ($q) use ($data) {
                $q->where('id', $data['child_category_id']);
            });
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
}
