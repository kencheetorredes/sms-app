<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwilioPhones extends Model
{
    protected $fillable = [
        'mobile',
        'status'
    ];

    public static function lists($key, $total = 0, $offset = 0, $limit = 10,$sort = '',$orderBy = ''){

        $sort_fiels  = [
            'mobile'      => 'mobile',
        ]; 

        $sql = self::whereNotNull('created_at');

        if( $key && $key != NULL ){
            $sql->where(function($searchlist) use ($key) {
                return  $searchlist->where('mobile','like','%'.$key.'%')
                        ->orWhere('label','like','%'.$key.'%');
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
