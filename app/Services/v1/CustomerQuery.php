<?php

namespace App\Services\v1;

use Illuminate\Http\Request;

class CustomerQuery
{
    protected $allowedFilters = [
         'name' => ['eq'],
         'type' => ['eq'],
         'email' => ['eq'],
         'address' => ['eq'],
         'city' => ['eq'],
         'province' => ['eq'],
         'postcode' => ['eq']
    ];

    protected $operatorMap = [
         'eq' => '=',
         'lt' => '<',
         'gt' => '>',
         'lte' => '<=',
         'gte' => '>='
    ];

    public function transform(Request $request)
    {
         $queryItems = [];

         foreach ($this->allowedFilters as $filter => $operators) {
            $query = $request->query($filter);
            
            if (!isset($query)) {
               continue;   
            }

            foreach ($operators as $operator) {
               if (isset($query)) {
                  $queryItems[] = [$filter, $this->operatorMap[$operator], $query[$operator]];
               }
            }

         }

         return $queryItems;
    }
}
