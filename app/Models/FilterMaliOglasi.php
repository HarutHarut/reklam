<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $listing_id
 * @property integer $f_id
 * @property integer $f_o_id
 * @property Filter $filter
 * @property MaliOglasi $maliOglasi
 */
class FilterMaliOglasi extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'listing_id',
        'f_id',
        'f_o_id'
    ];

    /**
     * @return BelongsTo
     */
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'f_id');
    }

    /**
     * @return BelongsTo
     */
    public function maliOglasi()
    {
        return $this->belongsTo(MaliOglasi::class, 'listing_id');
    }

    public function filterOption()
    {
        return $this->belongsTo(FiltersOption::class, 'f_o_id');
    }
}
