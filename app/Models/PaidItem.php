<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property float $price
 * @property integer $user_tip
 */
class PaidItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'price',
        'user_tip',
        'filters_show',
        'user_tcourseip',
        'statistics',
        'listing_count',
        'expiry_date',
    ];
}
