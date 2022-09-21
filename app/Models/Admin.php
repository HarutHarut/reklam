<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $ime
 * @property string $priimek
 * @property integer $level
 * @property integer $podjetje
 * @property string $geslo
 * @property string $datum
 */
class Admin extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ime', 'priimek', 'level', 'podjetje', 'geslo', 'datum'];
}
