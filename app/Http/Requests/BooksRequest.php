<?php

namespace Laravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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

    public function messages(){
      return $messages=[
        "author.required"=>"O nome do autor deve conter de 5 a 30 caracteres.",
        "title.required"=>"O título deve conter de 5 a 30 caracteres.",
        "isbn.required"=>"O ISBN deve conter 13 caracteres.",
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
          "author"=>"required|min:5|max:30",
          "title"=>"required|min:5|max:30",
          "isbn"=>"required|min:13|max:13",
            //
        ];
    }
}
