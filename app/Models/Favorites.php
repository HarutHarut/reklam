<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorites extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'favorites';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'mali_oglasi_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function mali_oglasi()
    {
        return $this->belongsTo(MaliOglasi::class);
    }
}
