<?php

namespace App\Services;

use App\Models\MaliOglasi;
use App\Repositories\SinglePageRepository;

/**
 * Class SinglePageService
 * @package App\Services
 */
class SinglePageService
{
    public static function listingData($listing_id)
    {
        $product = MaliOglasi::find($listing_id);
        $slug = $product->kategorijeTip1->slug;
        $categorySlug = $slug;
        $customFilters = SinglePageRepository::customFilters($product);
        $recommendations = SinglePageRepository::recommendations($product);
        $product->views_count = $product->views_count + 1;
        $product->save();
        $tipOglasa = SinglePageRepository::tipOglasa($product);

        return [
                'product' => $product,
                'tipOglasa' => $tipOglasa,
                'recommendations' => $recommendations,
                'categorySlug' => $categorySlug,
                'customFilters' => $customFilters
           ];
    }
}
