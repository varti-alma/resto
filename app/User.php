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
        'state'
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
      return $result = DB::table('users')
      ->where('id', $id)
      ->update([
        'name' => $request['name'],
        'surname' => $request['surname'],
        'telephone' => $request['telephone'],
        'document_id' => $request['document_id'],
        'birthday' => $request['birthday'],
        'gender' => $request['gender'],
        'region' => $request['region'],
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
    }

}
