<?php

namespace App\Filters;

class ProductSearchFilter
{
    function __invoke($query, $searchQuery)
    {
        if ($searchQuery) {
            $query_parts = explode(' ', $searchQuery);
            return $query->where(function ($q) use ($query_parts) {
                foreach ($query_parts as $search) {
                    $q->where('naslov', 'LIKE', '%' . $search . '%')
                        ->orWhere('opis', 'LIKE', '%' . $search . '%')
                        ->orWhere('keywords', 'LIKE', '%' . $search . '%');
                }
            });
        }
    }
}
