<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('orders', App\Http\Controllers\API\OrdersAPIController::class)
    ->except(['create', 'edit']);

Route::resource('products', App\Http\Controllers\API\ProductsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('cart-items', App\Http\Controllers\API\CartItemsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('countries', App\Http\Controllers\API\CountriesAPIController::class)
    ->except(['create', 'edit']);

Route::resource('customers', App\Http\Controllers\API\CustomersAPIController::class)
    ->except(['create', 'edit']);

Route::resource('customer-addresses', App\Http\Controllers\API\CustomerAddressesAPIController::class)
    ->except(['create', 'edit']);

Route::resource('payments', App\Http\Controllers\API\PaymentsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-items', App\Http\Controllers\API\OrderItemsAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-details', App\Http\Controllers\API\OrderDetailsAPIController::class)
    ->except(['create', 'edit']);