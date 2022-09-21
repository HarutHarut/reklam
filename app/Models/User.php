<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $access_token
 * @property string $provider_id
 * @property string $provider
 * @property string $avatar
 * @property string $remember_token
 * @property string $profile_photo_path
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticate
{
    //use Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'provider_id',
        'provider',
        'access_token',
        'remember_token',
        'profile_photo_path',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'id');

    }


    public function maliOglases()
    {
//        return $this->customer ? $this->customer->maliOglases() : null;
//        return $this->hasManyThrough(MaliOglasi::class, Customer::class, 'user_id', 'id');
        return $this->belongsToMany(MaliOglasi::class, 'customers', 'id', 'user_id')
            ->withPivot(['customers.maliOglases']);
    }

    /**
     * @return BelongsToMany
     */
    public function favorite()
    {
        return $this->belongsToMany(MaliOglasi::class, 'favorites');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function isAdmin(){
        return $this->role()->where('name','admin')->first();
    }

    public function isUser(){
        return $this->role()->where('name','user')->first();
    }

}
