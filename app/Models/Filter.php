<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $kat_id
 * @property string $naziv
 * @property integer $tip
 * @property FilterMaliOglasi[] $filterMaliOglases
 * @property Kategorije $kategorije
 * @property FiltersOption[] $filtersOptions
 */
class Filter extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'kat_id',
        'naziv',
        'tip',
        'is_mandatory'
    ];

    /**
     * @return HasMany
     */
    public function filterMaliOglases()
    {
        return $this->hasMany(FilterMaliOglasi::class, 'f_id');
    }

    /**
     * @return BelongsTo
     */
    public function kategorije()
    {
        return $this->belongsTo(Kategorije::class, 'kat_id');
    }

    /**
     * @return HasMany
     */
    public function filtersOptions()
    {
        return $this->hasMany(FiltersOption::class, 'f_id');
    }
}
