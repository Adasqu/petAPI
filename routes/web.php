<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::controller(PetController::class)->group(function () {
    Route::get('/', 'index')->name('pets.index');
    Route::get('/pet/{id}', 'show')->name('pets.show');
    Route::put('/pet', 'update')->name('pets.update');
    Route::post('/pet', 'store')->name('pets.store');
    Route::post('pets/{id}/uploadImage', 'uploadFile')->name('pets.uploadFile');
    Route::delete('/', 'destroy');
});
