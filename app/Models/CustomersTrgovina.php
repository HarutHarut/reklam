<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $c_id
 * @property integer $category_id
 * @property string $tocen_naziv
 * @property integer $davcna
 * @property string $trgovina_opis
 * @property string $slogan
 * @property string $delovni_cas
 * @property string $nacin_prevzema
 * @property string $spletna_stran
 * @property string $logo
 * @property string $xml_uvoz
 * @property CustomersCategory $customersCategory
 * @property Customer $customer
 */
class CustomersTrgovina extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'c_id',
        'category_id',
        'tocen_naziv',
        'davcna',
        'trgovina_opis',
        'slogan',
        'delovni_cas',
        'nacin_prevzema',
        'spletna_stran',
        'logo',
        'xml_uvoz'
    ];

    /**
     * @return BelongsTo
     */
    public function customersCategory()
    {
        return $this->belongsTo(CustomersCategory::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id');
    }

    /**
     * @return HasMany
     */
    public function listings()
    {
        return $this->hasMany(MaliOglasi::class, 'user_id', 'c_id');
    }
}
