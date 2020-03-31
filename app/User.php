<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'company_name', 'telephone', 'document_id', 'email', 'password',
        'region', 'city', 'availability', 'gender', 'birthday', 'schedule', 'address', 'user_type',
        'state', 'experiences', 'resto_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Edit an attentions instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public static function edit($request, $id)
    {
      $id_to_use = $id;
      $experiencesList = [];
      $experiences = $request;

      if(array_key_exists('resto-type-id', $request)){
        $resto_type_list = implode( ", ", array_values($request['resto-type-id']) );
      }else{
        $resto_type_list = "";
      }

      unset($experiences['_method']);
      unset($experiences['_token']);
      unset($experiences['name']);
      unset($experiences['surname']);
      unset($experiences['telephone']);
      unset($experiences['document_id']);
      unset($experiences['birthday']);
      unset($experiences['gender']);
      unset($experiences['region']);
      unset($experiences['city']);
      unset($experiences['resto-type-id']);
      unset($experiences['resto_type_other']);

      foreach($experiences as $key => $experience){
        $key_split = explode("-",$key);
        $id = $key_split[2];
        $experiencesList[$id] = $experience[0];
      }

      return $result = DB::table('users')
      ->where('id', '=',$id_to_use)
      ->update([
        'name' => $request['name'],
        'surname' => $request['surname'],
        'telephone' => $request['telephone'],
        'document_id' => $request['document_id'],
        'birthday' => $request['birthday'],
        'gender' => $request['gender'],
        'region' => $request['region'],
        'city' => $request['city'],
        'resto_type' => $resto_type_list,
        'experiences' => implode( ", ", array_values($experiencesList) ),
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
    }
    /**
     * get all users
     *
     * @param  Request  $request
     * @return Response
     */
    public static function getAllUser()
    {
      return DB::table('users')
        ->where('user_type', '=', '0')
        ->get();
    }
    /**
     * get all restorants
     *
     * @param  Request  $request
     * @return Response
     */
    public static function getAllRestorants()
    {
      return DB::table('users')
      ->where('user_type', '=', '1')
      ->get();
    }

}
