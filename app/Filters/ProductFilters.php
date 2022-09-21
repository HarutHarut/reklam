<?php

namespace App\Filters;

class ProductFilters
{
    /**
     * @var string[]
     */
    protected array $filters = [
        'searchQuery' => ProductSearchFilter::class,
        'priceRange' => PriceRangeFilter::class,
        'category' => CategoryFilter::class,
        'regions' => RegionFilter::class,
        'productType' => ProductTypeFilter::class,
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function apply($query): mixed
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }

        return $query;
    }

    /**
     * @return array
     */
    public function receivedFilters(): array
    {
        return request()->only(array_keys($this->filters));
    }
}
