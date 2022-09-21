<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $listing_id
 * @property integer $customer_id
 * @property Customer $customer
 * @property MaliOglasi $maliOglasi
 */
class ListingSafe extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['listing_id', 'customer_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maliOglasi()
    {
        return $this->belongsTo('App\Models\MaliOglasi', 'listing_id');
    }
}
