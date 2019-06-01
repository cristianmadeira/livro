<?php

namespace Laravel\Http\Controllers;

use Laravel\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("profiles.index")->with("profiles",Profile::with("user")->where("user_id","=",Auth::user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("profiles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type=$request->type;
        if(!strcasecmp($type,"admin")){
            $count=Profle::with("user")->where("type","=","admin")->count()->get();
            if($count >0)
                return view("profiles.create")->withErrors("Não pode ter dois perfis de administrador");

        }

        $user=Auth::user();

        $profile=new Profile();
        $profile->type=$type;
        $profile->user_id=$user->id;

        $user->profiles()->save($profile);
        return redirect("profiles")->with(["message"=>"Novo perfil criado com sucesso!"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \Laravel\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
        return view("profiles.show")->with("profile",$profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Laravel\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
        return view("profiles.create")->with("profile",$profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
        $profile->type=$request->profile;
        $profile->save();
        $error=false;
        $message="O Perifl atualizado com sucesso!!!";

      return redirect()->action("LoginController@logout")->with("request",Auth::user());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Laravel\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
        $profile->delete();
    }
}
