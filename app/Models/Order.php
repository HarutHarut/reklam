<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $cu_datum
 * @property integer $cu_user
 * @property integer $cu_company
 * @property integer $cu_subjekt
 * @property string $cu_naziv
 * @property string $cu_telefon
 * @property string $cu_email
 * @property string $cu_naslov
 * @property string $cu_posta
 * @property string $cu_davcna
 * @property integer $cu_ureditev
 * @property float $cu_ddv
 * @property string $cu_komentar
 * @property float $cu_znesek
 * @property integer $cu_nacin_predplacila
 * @property integer $cu_status_placila
 * @property string $cu_ponudba
 * @property string $cu_racun
 * @property string $cu_date_racun
 * @property StoritevToOrder[] $storitevToOrders
 */
class Order extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'cu_datum',
        'cu_user',
        'cu_company',
        'cu_subjekt',
        'cu_naziv',
        'cu_telefon',
        'cu_email',
        'cu_naslov',
        'cu_posta',
        'cu_davcna',
        'cu_ureditev',
        'cu_ddv',
        'cu_komentar',
        'cu_znesek',
        'cu_nacin_predplacila',
        'cu_status_placila',
        'cu_ponudba',
        'cu_racun',
        'cu_date_racun'
    ];

    /**
     * @return HasMany
     */
    public function storitevToOrders()
    {
        return $this->hasMany(StoritevToOrder::class, 'o_cu_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cu_user', 'id');
    }
}
