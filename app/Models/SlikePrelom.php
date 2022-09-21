<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $oglasnik
 * @property integer $rubrika
 * @property integer $oglas_id
 */
class SlikePrelom extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['oglasnik', 'rubrika', 'oglas_id'];
}
