<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RestoType extends Model
{
    /**
    * Edit an attentions instance.
    *
    * @param  Request  $request
    * @return Response
    */
   public static function getList($idList)
   {
     $result = DB::table('resto_types')
     ->select('description')
     ->whereIn('resto_type_id', explode(', ', $idList))->get()->toArray();
     return array_values($result);
   }

}
