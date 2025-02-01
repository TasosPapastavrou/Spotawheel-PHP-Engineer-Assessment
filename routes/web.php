<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// CLIENTS


//client show view
Route::get('/show/clients',[App\Http\Controllers\ClientController::class,"showListClient"])->name("show.clients");
Route::get('/add/client',[App\Http\Controllers\ClientController::class,"createClient"])->name("add.client");
Route::get('/update/client/{id}',[App\Http\Controllers\ClientController::class,"updateClient"])->name("update.client");
Route::get('/view/client/{id}',[App\Http\Controllers\ClientController::class,"viewClient"])->name("view.client");

//return data from clients using datatable
Route::post('/get/clients/datatable',[App\Http\Controllers\ClientController::class,"getClientDataTables"])->name("get.clients.datatable");


//action for clients
Route::post('/store/new/client',[App\Http\Controllers\ClientController::class,"storeNewClient"])->name("store.new.client");
Route::post('/update/client/data/{id}',[App\Http\Controllers\ClientController::class,"updateClientData"])->name("update.client.data");
Route::get('/delete/client/data/{id}',[App\Http\Controllers\ClientController::class,"deleteClientData"])->name("delete.client.data");

//seed select2 with clients for payments
Route::get('/get/payment/json',[App\Http\Controllers\ClientController::class,"getAllClients"])->name("get.clients.data");



// PAYMENTS 


//payment show view
Route::get('/show/payments',[App\Http\Controllers\PaymentController::class,"showListPayment"])->name("show.payments");
Route::get('/add/payment',[App\Http\Controllers\PaymentController::class,"createPayment"])->name("add.payment");
Route::get('/view/payment/{id}',[App\Http\Controllers\PaymentController::class,"viewPayment"])->name("view.payment");
Route::get('/update/payment/{id}',[App\Http\Controllers\PaymentController::class,"updatePayment"])->name("update.payment");


//return data from payments using datatable
Route::post('/get/payments/datatable',[App\Http\Controllers\PaymentController::class,"getDatatablePayments"])->name("get.payments.datatable");


//action for payment
Route::post('/store/new/payment',[App\Http\Controllers\PaymentController::class,"storeNewPayment"])->name("store.new.payment");
Route::post('/update/payment/data/{id}',[App\Http\Controllers\PaymentController::class,"updatePaymentData"])->name("update.payment.data");
Route::get('/delete/payment/data/{id}',[App\Http\Controllers\PaymentController::class,"deletePayment"])->name("delete.payment.data");

 
