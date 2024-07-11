<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'client_id',
        'message',
        'number',
        'type',
        'is_read',
        'twillio_no_id'
    ];

    public function contact(){
        return $this->hasOne(Contacts::class,'id','client_id');
    }
}
