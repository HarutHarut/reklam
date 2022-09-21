<?php

namespace App\Repositories;

use App\Models\Filter;
use App\Models\MaliOglasi;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class SinglePageRepository.
 */
class SinglePageRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return MaliOglasi::class;
    }

    /**
     * @param $product
     * @return mixed
     */
    public static function recommendations($product){

       return MaliOglasi::where('cena', $product->cena)
            ->where('id', '!=', $product->id)
            ->where('regija_id', $product->regija_id)
            ->where('tip_oglasa', $product->tip_oglasa)
            ->limit(config('constants.recommendationCount'))
            ->get();
    }

    /**
     * @param $product
     * @return array
     */
    public static function customFilters($product){
        $customFilters = [];
        foreach ($product->customFilters->groupBy('f_id') as $key => $value){
            $filter = Filter::find($key);
            if(count($value) > 1){
                $optionsName = [];
                foreach ($value as $item){
                    $optionsName[] = $item->filterOption->option;
                }
                $value = implode(', ', $optionsName);
            }else{
                if($filter->tip !== 2){
                    $value = $value[0]->filterOption ? $value[0]->filterOption->option : '';
                }else{
                    $value = $product->customFilters->where('f_id', $key)->first()->f_o_id;
                }
            }
            $customFilters[$filter->naziv] = $value;
        }
        return $customFilters;
    }

    /**
     * @param $product
     * @return int|mixed|string|null
     */
    public static function tipOglasa($product){
        $tipOglasa = null;

        foreach (config('constants.product_type') as $key => $item) {
            if ($item == $product->tip_oglasa) {
                $tipOglasa = $key;
                break;
            }
        }
        return $tipOglasa;
    }
}
