<?php

namespace App\Models;

use App\Models\TwilioPhones;
use Illuminate\Database\Eloquent\Model;

class UserNumbers extends Model
{
    protected $fillable = [
        'user_id',
        'twillio_nunber'
    ];

    public  function number(){
        return $this->hasOne(TwilioPhones::class,'id','twillio_nunber');
    }
}
