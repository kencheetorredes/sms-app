<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLogs extends Model
{
    protected $fillable = [
        'client_id',
        'number',
        'error',
        'message'
    ];
}
