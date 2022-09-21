<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $o_cu_id
 * @property string $o_naziv
 * @property float $o_cena
 * @property integer $o_item_id
 * @property integer $o_listing_id
 * @property integer $o_kolicina
 * @property Order $order
 */
class StoritevToOrder extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'o_cu_id',
        'o_naziv',
        'o_cena',
        'o_item_id',
        'o_listing_id',
        'o_kolicina'
    ];

    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'o_cu_id');
    }
}
