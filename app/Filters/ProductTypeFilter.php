<?php

namespace App\Filters;

class ProductTypeFilter
{
    function __invoke($query, $productType)
    {
        if (!is_array($productType)) {
            $productType = json_decode($productType);
        }
        if (count($productType)) {
            return $query->whereIn('tip_oglasa', $productType);
        }
    }
}
