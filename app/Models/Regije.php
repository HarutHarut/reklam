<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $country_id
 * @property string $regija
 * @property integer $parent_id
 * @property integer $vrstni_red
 * @property string $postna_st
 * @property float $dolžina
 * @property float $širina
 * @property MaliOglasi[] $maliOglases
 * @property Country $country
 */
class Regije extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'country_id',
        'regija',
        'parent_id',
        'vrstni_red',
        'postna_st',
        'dolžina',
        'širina'
    ];

    /**
     * @return HasMany
     */
    public function maliOglases()
    {
        return $this->hasMany(MaliOglasi::class, 'regija_id');
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
    public function child()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // TODO change query to not show only slovenian regions

    /**
     * @return Builder[]|Collection
     */
    public static function getSlovenianRegions()
    {
        return self::query()
            ->where(['country_id' => 1, 'parent_id' => 0])
            ->orderByDesc('vrstni_red')
            ->get();
    }
}
