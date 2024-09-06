<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
route::resource('invoice', InvoiceController::class)->middleware('auth');
