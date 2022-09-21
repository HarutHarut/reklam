<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $status
 * @property boolean $subjekt
 * @property string $username
 * @property string $email_address
 * @property integer $country_code
 * @property integer $telefon
 * @property integer $telefon2
 * @property string $tel_opis
 * @property string $tel2_opis
 * @property integer $regija_id
 * @property string $naslov
 * @property integer $num_oglasov
 * @property string $password
 * @property string $account_created
 * @property string $last_login
 * @property integer $number_logins
 * @property CustomersTrgovina[] $customersTrgovinas
 * @property ListingSafe[] $listingSaves
 * @property MaliOglasi[] $maliOglases
 */
class Customer extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'subjekt',
        'username',
        'email_address',
        'country_code',
        'telefon',
        'telefon2',
        'tel_opis',
        'tel2_opis',
        'regija_id',
        'naslov',
        'num_oglasov',
        'password',
        'account_created',
        'last_login',
        'number_logins'
    ];

    /**
     * @return HasMany
     */
    public function customersTrgovinas()
    {
        return $this->hasMany(CustomersTrgovina::class, 'c_id');
    }

    /**
     * @return HasMany
     */
    public function listingSaves()
    {
        return $this->hasMany(ListingSafe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function maliOglases()
    {
        return $this->hasMany(MaliOglasi::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function maliOglasesWithLimit()
    {
        return $this->maliOglases()->where(['status' => true])->take(3);
    }

    /**
     * @return BelongsTo
     */
    public function regija()
    {
        return $this->belongsTo(Regije::class);
    }

    /**
     * @return BelongsTo
     */
    public function activePackage()
    {
        return $this->belongsTo(CustomerPackage::class, 'id', 'customer_id');
    }
}
