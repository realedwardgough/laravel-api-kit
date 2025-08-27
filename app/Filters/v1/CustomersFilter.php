<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter
{
   protected $allowedFilters = [
      'name' => ['eq'],
      'type' => ['eq', 'neq'],
      'email' => ['eq'],
      'address' => ['eq'],
      'city' => ['eq'],
      'province' => ['eq'],
      'postcode' => ['eq']
   ];

   protected $operatorMap = [
      'eq' => '=',
      'neq' => '!=',
      'lt' => '<',
      'gt' => '>',
      'lte' => '<=',
      'gte' => '>='
   ];

}
