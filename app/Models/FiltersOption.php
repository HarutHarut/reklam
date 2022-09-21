<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $f_id
 * @property string $option
 * @property Filter $filter
 */
class FiltersOption extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'f_id',
        'option'
    ];

    /**
     * @return BelongsTo
     */
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'f_id');
    }
}
