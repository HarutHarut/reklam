<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockPhone extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
      'phone_number',
      'description',
      'status',
    ];


}
