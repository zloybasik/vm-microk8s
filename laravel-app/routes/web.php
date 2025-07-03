<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Новый маршрут:
Route::get('/hello', function () {
    return 'Hello, world!';
});

// Маршрут для about:
Route::get('/about', function () {
    return view('about');
});
