<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Customer;
use App\Http\Requests\v1\StoreCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CustomerResource;
use App\Http\Resources\v1\CustomerCollection;
use App\Filters\v1\CustomersFilter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {

      // Handle the filters
      $filter = new CustomersFilter();
      $filterItems = $filter->transform($request);

      // Check for includes of invoices query parameter
      $includeInvoices = $request->query('includesInvoices');

      // Retrieve the customers and filter them
      $customers = Customer::where($filterItems);

      // Included invoices if requested
      if ($includeInvoices) {
         $customers = $customers->with('invoices');
      }

      // Return the customers as a resource collection
      return new CustomerCollection(
         $customers->paginate()->appends($request->query())
      );

   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreCustomerRequest $request)
   {
      return new CustomerResource(Customer::create($request->all()));
   }

   /**
    * Display the specified resource.
    */
   public function show(Customer $customer)
   {
      // Check for includes of invoices query parameter
      $includeInvoices = request()->query('includesInvoices');

      // Included invoices if requested
      if ($includeInvoices) {
         return new CustomerResource($customer->loadMissing('invoices'));
      }

      return new CustomerResource($customer);
   }

   /**
    * Update the specified resource in storage.
    */
   /*
   public function update(UpdateCustomerRequest $request, Customer $customer)
   {
      //
   }
   */

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Customer $customer)
   {
      //
   }
}
