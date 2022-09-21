<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $listing_id
 * @property string $title
 * @property integer $sort
 * @property MaliOglasi $maliOglasi
 */
class ListingImage extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'listing_id',
        'title',
        'url',
        'sort'
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function maliOglasi()
    {
        return $this->belongsTo(MaliOglasi::class, 'listing_id');
    }

    /**
     * @return BelongsTo
     */
    public function parentImage()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

}
