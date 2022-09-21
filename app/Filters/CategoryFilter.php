<?php

namespace App\Filters;

use App\Models\Kategorije;

class CategoryFilter
{
    /**
     * @param $query
     * @param $category
     * @return mixed
     */
    function __invoke($query, $slug): mixed
    {
        $category = Kategorije::where('slug', $slug)->first();
        return $query->whereHas($category->parent_id ? 'kategorijeTip1' : 'kategorijeTip0', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
}
