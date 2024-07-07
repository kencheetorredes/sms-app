<?php

namespace App\Models;

use App\Models\CountryCodes;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
   protected $fillable = [
    'name',
    'mobile',
    'group_id',
    'country_code_id',
    'status'
   ];

   public function code(){
    return $this->hasOne(CountryCodes::class,'id','country_code_id');
   }

   public function group(){
    return $this->hasOne(Groups::class,'id','group_id');
   }

   public static function lists($search, $total = 0, $offset = 0, $limit = 10,$sort = '',$orderBy = ''){

    $sort_fiels  = [
        'name'      => 'name',
        'status_'   => 'status'
    ]; 

    $sql = self::whereNotNull('created_at');

    if( isset($search['key']) && $search['key'] != NULL ){
        $sql->where(function($searchlist) use ($search) {
            return  $searchlist->where('name','like','%'.$search['key'].'%')
            ->orWhere('mobile','like','%'.$search['key'].'%');
        });
    }

    if( isset($search['group_id']) && $search['group_id'] != NULL ){
        $sql->where('group_id',$search['group_id']);
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
 