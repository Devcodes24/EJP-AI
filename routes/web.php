<?php

use App\Http\Controllers\ai1;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ai2',[ai1::class, 'front_page']);
Route::post('/ai2',[ai1::class, 'index']);