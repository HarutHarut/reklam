<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $tip0
 * @property integer $tip1
 * @property integer $tip_id
 * @property integer $regija_id
 * @property boolean $status
 * @property boolean $tip_oglasa
 * @property integer $tip2
 * @property integer $tip3
 * @property integer $tip4
 * @property string $naslov
 * @property string $opis
 * @property string $keywords
 * @property float $cena
 * @property string $date_sort
 * @property string $datum_vnosa
 * @property string $datum_spremembe
 * @property string $datum_poteka
 * @property string $datum_poslanega_opozorila
 * @property string $sifra
 * @property FilterMaliOglasi[] $filterMaliOglases
 * @property ListingImage[] $listingImages
 * @property ListingSafe[] $listingSaves
 * @property MaliOglasiKontakt[] $maliOglasiKontakts
 * @property Customer $customer
 * @property Regije $regije
 * @property Kategorije $kategorije
 * @property Kategorije $kategorije
 * @property Kategorije $kategorije
 * @property Zloraba[] $zlorabas
 */
class MaliOglasi extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'mali_oglasi';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tip0',
        'tip1',
        'tip_id',
        'regija_id',
        'status',
        'tip_oglasa',
        'tip2',
        'tip3',
        'tip4',
        'naslov',
        'slug',
        'opis',
        'keywords',
        'cena',
        'date_sort',
        'datum_vnosa',
        'datum_spremembe',
        'datum_poteka',
        'datum_poslanega_opozorila',
        'sifra',
        'notify_expiration',
        'warning_sent'
    ];

    /**
     * @return HasMany
     */
    public function filterMaliOglases()
    {
        return $this->hasMany(FilterMaliOglasi::class, 'listing_id');
    }

    /**
     * @return HasMany
     */
    public function listingImages()
    {
        return $this->hasMany(ListingImage::class, 'listing_id');
    }

    /**
     * @return HasMany
     */
    public function listingImagesThumb()
    {
        return $this->listingImages()->where('sort', config('constants.images_type.thumb'));
    }

    /**
     * @return HasMany
     */
    public function listingImagesPresent()
    {
        return $this->listingImagesThumb()->where('present', 1);
    }

    /**
     * @return HasMany
     */
    public function listingImagesFull()
    {
        return $this->listingImages()->where('sort', config('constants.images_type.full'));
    }

    /**
     * @return HasMany
     */
    public function listingSaves()
    {
        return $this->hasMany(ListingSafe::class, 'listing_id');
    }

    /**
     * @return HasMany
     */
    public function maliOglasiKontakts()
    {
        return $this->hasMany(MaliOglasiKontakt::class, 'listing_id');
    }

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function customersTrgovinas()
    {
        return $this->belongsTo(CustomersTrgovina::class, 'user_id','c_id');
    }

    /**
     * @return BelongsTo
     */
    public function regije()
    {
        return $this->belongsTo(Regije::class, 'regija_id');
    }

    /**
     * @return BelongsTo
     */
    public function kategorijeTip0()
    {
        return $this->belongsTo(Kategorije::class, 'tip0');
    }

    /**
     * @return BelongsTo
     */
    public function kategorijeTip1()
    {
        return $this->belongsTo(Kategorije::class, 'tip1');
    }

    /**
     * @return BelongsTo
     */
    public function kategorijeTipId()
    {
        return $this->belongsTo(Kategorije::class, 'tip_id');
    }

    /**
     * @return HasMany
     */
    public function zlorabas()
    {
        return $this->hasMany(Zloraba::class, 'id_oglasa');
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters): mixed
    {
        return $filters->apply($query);
    }

    /**
     * @param $query
     * @param $column
     * @param string $direction
     * @return mixed
     */
    public function scopeSort($query, $column, string $direction = 'DESC'): mixed
    {
        if ($column) {
            return $query->orderBy($column, $direction);
        }
        return $query->orderBy('id', 'desc');
    }

    public function customFilters()
    {
        return $this->hasMany(FilterMaliOglasi::class, 'listing_id');
    }

    public function productType($key)
    {
        $value = '';
        foreach (config('constants.all_product_type') as $k => $item){
            if($k == $key){
                $value = $item;
            }
        }
        return $value;
    }
}
