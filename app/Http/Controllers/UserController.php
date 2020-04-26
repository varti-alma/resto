<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Experience;
use App\RestoType;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        $experience = Experience::orderBy('description', 'ASC')->get();
        $resto_type = RestoType::orderBy('description', 'ASC')->get();
        return view('person/index', [
            'user' => $user,
            'experience' => $experience,
            'resto_type' => $resto_type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileName = $id.'_'.rand().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path('avatars'), $fileName );
        $request['filename'] = $fileName;
        $result = User::edit($request->all(), $id);
        $user = User::find($id);

        $experience = Experience::orderBy('description', 'ASC')->get();
        $resto_type = RestoType::orderBy('description', 'ASC')->get();

        if($user->user_type == '0')
            return view('company/index', [
                'user'=>$user,
                'experience' => $experience,
                'resto_type' => $resto_type
            ]);

        return view('person/index', [
            'user'=>$user,
            'experience' => $experience,
            'resto_type' => $resto_type]
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Rescatar listado de ciudad según región informado
     *
     * @param  int  $idRegion
     * @return \Illuminate\Http\Response
     */
    public function getCity($idRegion)
    {
        //
        return cityList($idRegion);
    }
}
