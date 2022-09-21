<?php

namespace App\Filters;

class PriceRangeFilter
{
    /**
     * @param $query
     * @param $priceRange
     * @return mixed
     */
    function __invoke($query, $priceRange): mixed
    {
        list($min, $max) = explode(";", $priceRange);
        return $query->where('cena', '>=', $min)
            ->where('cena', '<=', $max);
    }
}
