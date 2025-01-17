<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\petController;
Route::controller(PetController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});
Route::get('/', function () {
    return view('index');
});
