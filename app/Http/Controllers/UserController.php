<?php
namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\User;
use Laravel\Contact;
use Laravel\Profile;
use Laravel\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("users.index")->with("users",User::with("contact")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        User::create(
          array(
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "created_at"=>date('Y-m-d G:i:s')

          )
        );
        $error=false;

        $message="Usuário cadastrado com sucesso!";
        return redirect("users")->with(
            array(
                "error"=>$error,
                "message"=>$message

            )
         );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Laravel\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("users.show")->with("user",$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Laravel\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view("users.create")->with("user",$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
        //

        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->updated_at=$user->updated_at = date('Y-m-d G:i:s');

        $contact=$user->contact()->find($user->id);
        $contact->cell_phone=$request->cell_phone;
        $contact->phone=$request->phone;
        $contact->user_id=$user->id;

        //$profile =$user->profiles()->find($user->id);
        //$profile->type=$request->profile;
        //$profile->user_id=$user->id;

        //$user->profiles()->save($profile);
        $user->contact()->save($contact);
        $user->save();
        return redirect("users")->with(["error"=>false,"message"=>"Usuário atualizado com sucesso!"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Laravel\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      if(empty($user)){
        $error=true;
        $message="Erro ao excluir.";
      }
      else{
        $user->contact()->delete();
        $user->delete();
        $error=false;
        $message="Usuário removido com sucesso!";
      }
      if(Auth::user()->id == $user->id)
        return redirect("/");

        return redirect("users")->with(
          array(
            "error"=>$error,
            "message"=>$message
          )

        );
    }
}
