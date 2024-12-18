<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return '<html><body><h1>Hello</h1><p>Laravel開始！</p></body></html>';
});
