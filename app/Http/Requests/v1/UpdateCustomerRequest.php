<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    */
   public function authorize(): bool
   {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
   public function rules(): array
   {
      $method = $this->method();

      if ($method === 'PUT') {
         return [
            'name' => ['required'],
            'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'postcode' => ['required']
         ];
      }

      else {
         return [
            'name' => ['sometimes', 'required'],
            'type' => ['sometimes', 'required', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['sometimes', 'required', 'email'],
            'address' => ['sometimes', 'required'],
            'city' => ['sometimes', 'required'],
            'province' => ['sometimes', 'required'],
            'postcode' => ['sometimes', 'required']
         ];
      }

      
   }
}
