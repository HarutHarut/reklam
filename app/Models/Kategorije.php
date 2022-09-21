<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $tip
 * @property boolean $status
 * @property integer $vrstni_red
 * @property Filter[] $filters
 * @property Kategorije $kategorije
 * @property MaliOglasi[] $maliOglasesTip0
 * @property MaliOglasi[] %maliOglasesTip1
 * @property MaliOglasi[] $maliOglasesTipId
 */
class Kategorije extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'tip',
        'slug',
        'color_filters',
        'color_dropdown',
        'icon',
        'status',
        'paid',
        'vrstni_red'
    ];

    /**
     * @return HasMany
     */
    public function filters()
    {
        return $this->hasMany(Filter::class, 'kat_id');
    }

    /**
     * @return BelongsTo
     */
    public function kategorije()
    {
        return $this->belongsTo(Kategorije::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->with('parent');
    }

    /**
     * @return HasMany
     */
    public function maliOglasesTip0()
    {
        return $this->hasMany(MaliOglasi::class, 'tip0');
    }

    /**
     * @return HasMany
     */
    public function maliOglasesTip1()
    {
        return $this->hasMany(MaliOglasi::class, 'tip1');
    }

    /**
     * @return HasMany
     */
    public function maliOglasesTipId()
    {
        return $this->hasMany(MaliOglasi::class, 'tip_id', 'id');
    }
}
