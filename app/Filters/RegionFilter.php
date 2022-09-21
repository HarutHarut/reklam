<?php

namespace App\Filters;

class RegionFilter
{
    /**
     * @param $query
     * @param $regions
     * @return mixed|void
     */
    function __invoke($query, $regions)
    {
        if (!is_array($regions)) {
            $regions = json_decode($regions);
        }
        if (count($regions)) {
            return $query->whereIn('regija_id', $regions);
        }
    }
}
