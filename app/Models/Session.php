<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property integer $user_id
 * @property string $ip_address
 * @property string $user_agent
 * @property string $payload
 * @property integer $last_activity
 */
class Session extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];
}
