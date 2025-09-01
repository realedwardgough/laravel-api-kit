<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{

   /**
    * Determine if the user is authorized to make this request.
    */
   public function authorize(): bool
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
   public function rules(): array
   {
      return [
         '*.customerId' => ['required', 'integer'],
         '*.amount' => ['required', 'numeric'],
         '*.status' => ['required', Rule::in('B', 'P', 'V', 'b', 'p', 'v')],
         '*.billed_date' => ['required', 'date_format:Y-m-d H:i:s'],
         '*.paid_date' => ['date_format:Y-m-d H:i:s', 'nullable']
      ];
   }

    /**
    * Resolve validation issues when a column is named differently to
    * the database column. This instance it is customerID to customer_id.
    */
    protected function prepareForValidation()
    {
        
        // Iterate through the fields and store renamed customer id
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $data[] = $obj;
        }

        // Merge arrays for easy access to the updated column name
        $this->merge($data);
    }
}
