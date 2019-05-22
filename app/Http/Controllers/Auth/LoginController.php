<?php

namespace Laravel\Http\Controllers\Auth;

use Laravel\Http\Controllers\Controller;
use Laravel\Profile;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Laravel\Http\Requests\UsersRequest;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $email=$request->get("email");
        $password=$request->get("password");
        $typeProfile=$request->get("profile");
        $user=User::where("email",$email)->first();
        if(!empty($user)){
            if(Hash::check($password,$user->password)){
                    $profile=$user->profiles()->where("type",$typeProfile)->first();
                    //Cria uma sessão para o perfil para que possa se verificado as permissões.
                    $request->session()->put("profile",$profile);

                    if(!empty($profile)){
                        auth()->login($profile->user);
                        return $this->sendLoginResponse($request);
                    }
                    else{
                        return $this->sendFailedLoginResponse($request,array("profile"=>"Perfil incorreto"));

                    }

            }else{
                return $this->sendFailedLoginResponse($request,array("password"=>"Senha incorreta"));

            }

        }
        return $this->sendFailedLoginResponse($request,array("email"=>"Email ou senha incorretos"));


    }
    protected function sendFailedLoginResponse(Request $request, array $data)
    {
        throw ValidationException::withMessages($data);
    }


  }
