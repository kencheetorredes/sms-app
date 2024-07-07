<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCodes extends Model
{
    protected $fillable = [
        'country',
        'code',
        'country_short_name'
    ];

    public static function lists($key, $total = 0, $offset = 0, $limit = 10,$sort = '',$orderBy = ''){

        $sort_fiels  = [
            'country'      => 'country',
        ]; 

        $sql = self::whereNotNull('created_at');

        if( $key && $key != NULL ){
            $sql->where(function($searchlist) use ($key) {
                return  $searchlist->where('country','like','%'.$key.'%')
                ->orWhere('code','like','%'.$key.'%');
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
