<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter
{

   protected $allowedFilters = [
      'customer_id' => ['eq'],
      'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
      'status' => ['eq', 'neq'],
      'billed_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
      'paid_date' => ['eq', 'lt', 'gt', 'lte', 'gte']
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
