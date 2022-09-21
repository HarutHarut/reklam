<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_to_id',
        'from_email',
        'to_email',
        'cc',
        'bcc',
        'subject',
        'content',
        'priority',
        'attempts',
        'template_name',
        'status',
        'schedule_date',
        'date_sent',
        'email_type'
    ];
}
