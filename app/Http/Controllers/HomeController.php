<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\RestoType;

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
        foreach($userList as $key => $user){
            $userListUpdated[$key] = $user;
            $resto_type = RestoType::getList($user->resto_type);
            $userListUpdated[$key]->resto_type = getRestoTypeName($resto_type);
        }
        return view('home', ['userLogged'=>$userLogged, 'userList'=>$userListUpdated]);
    }
}
