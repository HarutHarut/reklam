<?php

namespace App\Services;

use App\Models\Kategorije;
use App\Models\MaliOglasi;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{
    /**
     * @param $slug
     * @param array $data
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function categoryIndex($slug, $data = [])
    {
        $customFilter = [];
        if (isset($data['custom_filters'])) {
            $data['custom_filters'] = json_decode($data['custom_filters']) ?? [];
            foreach ($data['custom_filters'] as $key => $item) {
                $key = substr($key, strpos($key, "-") + 1);
                $customFilter[$key] = $item;
            }
        }
        $data['custom_filters'] = $customFilter;

        $category = Kategorije::query()
            ->where('status', 1)
            ->where('slug', $slug)
            ->with(['filters', 'children', 'parent', 'kategorije.children'])
            ->firstOrFail();

        $categoryParent = FilterServices::categoryAlphaParent($category);
        $categoryColor = $categoryParent->color_filters;
        $categoryFilters = $categoryParent->filters;
        $productTypes = config('constants.product_type');

        if ($categoryParent->slug == 'zasebni-stiki' || $categoryParent->slug == 'storitve-in-delo') {
            $productTypes = config('constants.private_product_type');
        }
        $products = MaliOglasi::with(['kategorijeTip1', 'kategorijeTip0'])
            ->whereHas($category->parent_id ? 'kategorijeTip1' : 'kategorijeTip0', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });

        $products = FilterServices::productFilters($products, $data);

        if (request()->get('sortType')) {
            $products = $products->sort(request()->get('sortType'));
        } else {
            $products = $products->orderBy('date_sort', 'desc');
        }
        $maxPrice = max_price($products);
        $result = $products->paginate(config('constants.per_page'));
        $resultCount = $result->total();

        return [
            'category' => $category,
            'categoryFilters' => $categoryFilters,
            'categoryColor' => $categoryColor,
            'categoryParent' => $categoryParent,
            'result' => $result,
            'productTypes' => $productTypes,
            'resultCount' => $resultCount,
            'maxPrice' => $maxPrice
        ];
    }
}
