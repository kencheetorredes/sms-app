<?php

namespace App\Models;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Model;

class ErrorLogs extends Model
{
    protected $fillable = [
        'client_id',
        'number',
        'error',
        'message',
        'twillio_no_id'
    ];

    public function client(){
        return $this->hasOne(Contacts::class,'id','client_id');
    }

    public function mobile(){
        return $this->hasOne(TwilioPhones::class,'id','twillio_no_id');
    }

    public static function lists($key, $total = 0, $offset = 0, $limit = 10,$sort = '',$orderBy = ''){

        $sort_fiels  = [
            'created_at'      => 'created_at',
        ]; 

        $sql = self::whereNotNull('created_at');

        if( $key && $key != NULL ){
            $sql->where(function($searchlist) use ($key) {
                return  $searchlist->where('number','like','%'.$key.'%');
            });
        }

        if( $total == 1 ){
            $sql->skip($offset)->take($limit);
        }

        if($sort){
           
            $sql->orderBy($sort_fiels[$sort],$orderBy);

        } else {
            $sql->orderBy('id','DESC');
        }

        return  $sql;       
    }
}
