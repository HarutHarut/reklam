<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $countries_name
 * @property integer $country_code
 * @property Regije[] $regijes
 */
class Country extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'countries_name',
        'country_code'
    ];

    /**
     * @return HasMany
     */
    public function regijes()
    {
        return $this->hasMany(Regije::class);
    }
}
