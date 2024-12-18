<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('hello', function () {
//     return '<html><body><h1>Hello</h1><p>Laravel開始！</p></body></html>'
//     ;
// });

Route::get('/hello', [HelloController::class, 'index']);
