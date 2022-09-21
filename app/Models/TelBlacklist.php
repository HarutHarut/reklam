<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $number
 */
class TelBlacklist extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['number'];
}
