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
        $experienceList = Experience::orderBy('description', 'ASC')->get();
        $restoTypeList = RestoType::orderBy('description', 'ASC')->get();

        $userListUpdated = array();
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
            'param' => array(
                'selected_region' => "",
                'city' => "",
                'experience-selected-id' => [],
                'resto-selected-id' => [],
            )
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
        // print_r($request->all());
        // exit;
        $userLogged = Auth::user();
        $userList = User::filterPeopleList($request->all());
        $experienceList = Experience::orderBy('description', 'ASC')->get();
        $restoTypeList = RestoType::orderBy('description', 'ASC')->get();
        $userListUpdated = array();
        foreach($userList as $key => $user){
            $userListUpdated[$key] = $user;
            $resto_type = RestoType::getList($user->resto_type);
            $userListUpdated[$key]->resto_type = getRestoTypeName($resto_type);
        }

        if(!array_key_exists('selected_region', $request->all())){ 
            $param['selected_region'] = ""; 
        } else {
            $param['selected_region'] = $request->all()['selected_region']; 
        }
        if(!array_key_exists('city', $request->all())){ 
            $param['city'] = ""; 
        } else {
            $param['city'] = $request->all()['city']; 
        }
        if(!array_key_exists('experience-selected-id', $request->all())){ 
            $param['experience-selected-id'] = []; 
        } else {
            $param['experience-selected-id'] = $request->all()['experience-selected-id']; 
        }
        if(!array_key_exists('resto-selected-id', $request->all())){ 
            $param['resto-selected-id'] = []; 
        } else {
            $param['resto-selected-id'] = $request->all()['resto-selected-id']; 
        }
        return view('home', [
            'userLogged' => $userLogged,
            'userList' => $userListUpdated,
            'experienceList' => $experienceList,
            'restoTypeList' => $restoTypeList,
            'param' => $param
        ]);
    }

}
