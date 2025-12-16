<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    dd(App\Models\User::findOrFail(1)->full_name);

    return view('welcome');
});
Route::get('/grid', function () {
    return view('grid');
});