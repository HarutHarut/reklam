<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerPackage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'paid_item_id',
        'package_duration'
    ];

    /**
     * @return BelongsTo
     */
    public function paidItem()
    {
        return $this->belongsTo(PaidItem::class, 'paid_item_id', 'id');
    }
}
