<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property boolean $personal_team
 * @property string $created_at
 * @property string $updated_at
 * @property TeamInvitation[] $teamInvitations
 */
class Team extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'personal_team', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamInvitations()
    {
        return $this->hasMany('App\Models\TeamInvitation');
    }
}
