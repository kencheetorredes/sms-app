<?php

namespace App\Models;

use App\Models\ContactGroups;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $fillable = [
        'name'
    ];

    public  function members(){
        return $this->hasMany(Contacts::class,'group_id','id');
    }

    public static function lists($key, $total = 0, $offset = 0, $limit = 10,$sort = '',$orderBy = ''){

        $sort_fiels  = [
            'name'      => 'name',
        ]; 

        $sql = self::whereNotNull('created_at');

        if( $key && $key != NULL ){
            $sql->where(function($searchlist) use ($key) {
                return  $searchlist->where('name','like','%'.$key.'%');
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
