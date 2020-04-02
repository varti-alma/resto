<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\RestoType;
use App\Experience;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userLogged = Auth::user();
        $userList = User::getAllUser();
        $experienceList = Experience::all();
        $restoTypeList = RestoType::all();

        foreach($userList as $key => $user){
            $userListUpdated[$key] = $user;
            $resto_type = RestoType::getList($user->resto_type);
            $userListUpdated[$key]->resto_type = getRestoTypeName($resto_type);
        }
        return view('home', [
            'userLogged' => $userLogged,
            'userList' => $userListUpdated,
            'experienceList' => $experienceList,
            'restoTypeList' => $restoTypeList,
            'param' => array()
        ]);
    }
    /**
     * Filtrar listado de personas según entrada
     *
     * @param  int  $idRegion
     * @param  int  $idCity
     * @param  string  $tags
     * @return \Illuminate\Http\Response
     */
    public function filterPeopleList(Request $request)
    {
        //
        //print_r($request->all());
        //exit;
        $userLogged = Auth::user();
        $userList = User::filterPeopleList($request->all());
        $experienceList = Experience::all();
        $restoTypeList = RestoType::all();
        $userListUpdated = array();
        foreach($userList as $key => $user){
            $userListUpdated[$key] = $user;
            $resto_type = RestoType::getList($user->resto_type);
            $userListUpdated[$key]->resto_type = getRestoTypeName($resto_type);
        }
        //return $userListUpdated;
        return view('home', [
            'userLogged' => $userLogged,
            'userList' => $userListUpdated,
            'experienceList' => $experienceList,
            'restoTypeList' => $restoTypeList,
            'param' => $request->all()
        ]);


    }

}
