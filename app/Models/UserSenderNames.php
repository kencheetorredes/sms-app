<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSenderNames extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sender_name_id'
    ];

    public  function details(){
        return $this->hasOne(SemaphoreSenderNames::class,'id','sender_name_id');
    }
}
