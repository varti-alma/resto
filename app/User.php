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
      unset($experiences['file']);
      unset($experiences['filename']);

      foreach($experiences as $key => $experience){
        $key_split = explode("-",$key);
        $id = $key_split[2];
        $experiencesList[$id] = $experience[0];
      }

      $data = [
        'name' => $request['name'],
        'surname' => $request['surname'],
        'telephone' => $request['telephone'],
        'region' => $request['region'],
        'city' => $request['city'],
        'resto_type' => $resto_type_list,
        'experiences' => implode( ", ", array_values($experiencesList) ),
        'updated_at' => date("Y-m-d H:i:s"),
      ];
      if(array_key_exists('filename', $request))
        $data['profile_photo'] = $request['filename'];
      if(array_key_exists('document_id', $request))
        $data['document_id'] = $request['document_id'];
      if(array_key_exists('birthday', $request))
        $data['birthday'] = $request['birthday'];
      if(array_key_exists('gender', $request))
        $data['gender'] = $request['gender'];

      return $result = DB::table('users')
      ->where('id', '=',$id_to_use)
      ->update($data);
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
     * get all active users
     *
     * @param  Request  $request
     * @return Response
     */
    public static function getAllActiveUser()
    {
      return DB::table('users')
      ->where('user_type', '=', '0')
      ->where('state', '=', '1')
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

    /**
     * filter People List
     *
     * @param  Request  $request
     * @return Response
     */
    public static function filterPeopleList($param)
    {
      $query = DB::table('users');
      $array = [];

      if($param['photo'])
        $array = ['id', 'name', 'surname', 'company_name', 'telephone', 'document_id',
        'region', 'city', 'email', 'availability', 'gender', 'birthday', 'schedule', 'address',
        'user_type', 'experiences', 'resto_type', 'profile_photo'];
      else
        $array = ['name', 'surname', 'telephone', 'document_id', 'region', 'city',
         'email', 'gender', 'birthday', 'address', 'experiences', 'resto_type'];

      $query->select($array);
      if(array_key_exists('selected_region', $param)){
        if($param['selected_region'] !== "-"){
          $query->where('region', $param['selected_region']);
        }
      }
      if(array_key_exists('city', $param)){
        if($param['city'] !== "-"){
          $query->where('city', $param['city']);
        }
      }
      $query->where('user_type', '0');
      $query->where('state', '1');
      
      if(array_key_exists('resto-selected-id', $param)){
        foreach($param['resto-selected-id'] as $key => $resto){
          $query->where('resto_type', 'like', '%'.$resto.'%');
        }
      }

      if(array_key_exists('experience-selected-id', $param)){
        foreach($param['experience-selected-id'] as $key => $experience){
          $query->where('experiences', 'like', '%'.$experience.'-%');
        }
      }
      if(array_key_exists('users', $param)){
        $query->whereIn('id', $param['users']);
      }

      return $query->get();
  }

}
