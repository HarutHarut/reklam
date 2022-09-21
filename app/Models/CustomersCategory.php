<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $cc_name
 * @property integer $cc_order
 * @property integer $cc_num_shops
 * @property CustomersTrgovina[] $customersTrgovinas
 */
class CustomersCategory extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable =
        [
            'cc_name',
            'slug',
            'cc_order',
            'cc_num_shops'
        ];

    /**
     * @return HasMany
     */
    public function customersTrgovinas()
    {
        return $this->hasMany(CustomersTrgovina::class, 'category_id');
    }
}
