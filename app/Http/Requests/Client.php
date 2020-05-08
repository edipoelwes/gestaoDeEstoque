<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Client extends FormRequest
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
         'company_id' => 'required',
         'name' => ['required', 'min:3', 'max:191'],
         'document' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:clients,document,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:clients,document'),
         'phone' => 'required',
      ];
   }
}
