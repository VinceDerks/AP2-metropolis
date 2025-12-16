<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'login'] , function () {

    Route::group(['middleware' => 'guest'] , function () {
        Route::get('/', [AuthController::class, 'create'])
            ->name('login');
        Route::post('/store', [AuthController::class, 'store'])
            ->name('login.store');
    });

    Route::delete('/destroy', [AuthController::class, 'destroy'])
        ->middleware('auth')->name('logout');

});

