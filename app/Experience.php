<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Experience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'experience_id', 'description', 'type'
    ];
    public static function getList($idList)
    {
        $list_split = explode(",",$idList);
        $experiencesId = [];
        foreach($list_split as $experience){
            $result = explode("-",$experience);
            array_push($experiencesId, $result[0]);
        }
        $result = DB::table('experiences')
        ->select()
        ->whereIn('experience_id', $experiencesId)->get()->toArray();
        return array_values($result);
    }
}
