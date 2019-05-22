<?php

namespace Laravel\Http\Controllers\Auth;

use Laravel\User;
use Laravel\Profile;
use Laravel\Contact;
use Laravel\Http\Controllers\Controller;
use Laravel\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function register(UsersRequest $request){
        //inserir Contact, profile, users;
        $user=new User();
        $user=User::create(
          array(
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),

          )
        );


        $contact=new Contact();
        $contact->cell_phone=$request->cell_phone;
        $contact->phone=$request->phone;
        $contact->user_id=$user->id;

        $profile=new Profile();
        $profile->type=$request->profile;
        $profile->user_id=$user->id;


        $user->profiles()->save($profile);
        $user->contact()->save($contact);

        $this->guard()->login($user);

        return redirect($this->redirectPath());

    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Laravel\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
