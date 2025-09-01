<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\InvoiceController;

// API Version 1.0.0
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\v1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore']);
});