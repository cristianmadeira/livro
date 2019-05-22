<?php

namespace Laravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }
    public function  messages(){
      return $messages=[
        "name.required"=>"o nome deve conter de 5 a 50 carecteres.",
        //"email.required"=>"O E-Mail deve conter  de 10 a 50 caracteres.",
        "password.required"=>"A senha deve conter no mínimo 8 caracteres.",
        "phone.required"=>"O telefone deve conter 10 caracteres.",
      ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => ['required', 'string','min:5', 'max:50'],
          //'email' => ['required', 'string', 'min:10', 'max:50', 'unique:users,email,'.Auth::user()->id],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          "phone"=>['required','string','min:10','max:10'],
          
            //
        ];
    }
}
