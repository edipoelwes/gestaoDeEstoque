<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return Auth::check();
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'name' => ['required', 'min:3', 'max:191'],
         'genre' => 'in:male,female,other',
         //'document' => 'required|min:11|max:14|unique:users',
         'document' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,document,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,document'),
         'document_secondary' => ['required', 'min:8', 'max:12'],
         'document_secondary_complement' => ['required'],
         'date_of_birth' => ['required', 'date_format:d/m/Y'],
         'place_of_birth' => 'required',
         'civil_status' => 'required|in:married,separated,single,divorced,widower',
         'cover' => 'image',

         // Address
         // 'zipcode' => ['required', 'min:8', 'max:9'],
         // 'street' => 'required',
         // 'number' => 'required',
         // 'neighborhood' => 'required',
         // 'state' => 'required',
         // 'city' => 'required',

         //Contact
         'cell' => 'required',

         //Access
         // 'email' => 'required|email|unique:users',
         // 'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),
         // 'password' => ['required', 'min:5'],
      ];
   }
}
