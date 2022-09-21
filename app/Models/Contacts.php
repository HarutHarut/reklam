<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'listing_name',
        'from_email',
        'to_email',
        'message'
    ];
}
