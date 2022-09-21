<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $id_oglasa
 * @property string $zloraba_razlogi
 * @property MaliOglasi $maliOglasi
 */
class Zloraba extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'id_oglasa',
        'zloraba_razlogi'
    ];

    /**
     * @return BelongsTo
     */
    public function maliOglasi()
    {
        return $this->belongsTo(MaliOglasi::class, 'id_oglasa');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
