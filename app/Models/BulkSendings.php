<?php

namespace App\Models;

use App\Models\Groups;
use App\Models\TwilioPhones;
use Illuminate\Database\Eloquent\Model;

class BulkSendings extends Model
{
    protected $fillable = [
        'group_id',
        'twillio_id',
        'scheduled',
        'status',
        'message',
        'created_by',
        'total',
        'send'
    ];

    public function group(){
        return $this->hasOne(Groups::class,'id','group_id');
    }

    public function mobile(){
        return $this->hasOne(TwilioPhones::class,'id','twillio_id');
    }

    public static function lists($key, $total = 0, $offset = 0, $limit = 10,$sort = '',$orderBy = ''){

        $sort_fiels  = [
            'date'      => 'created_at',
            'id'      => 'id',
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
            $sql->orderBy('id','asc');
        }

        return  $sql;       
    }
}
