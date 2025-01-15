<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpMessages extends Model
{
    protected $fillable = [
        'message',
        'number',
        'type',
        'is_read',
        'twillio_no_id'
    ];
}
