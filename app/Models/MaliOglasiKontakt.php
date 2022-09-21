<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $listing_id
 * @property integer $country_code
 * @property integer $telefon
 * @property string $kontakt_email
 * @property integer $sms_verfied
 * @property MaliOglasi $maliOglasi
 */
class MaliOglasiKontakt extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'listing_id',
        'country_code',
        'telefon',
        'kontakt_email',
        'sms_verfied'
    ];

    /**
     * @return BelongsTo
     */
    public function maliOglasi()
    {
        return $this->belongsTo(MaliOglasi::class, 'listing_id');
    }
}
