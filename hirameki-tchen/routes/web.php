<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KitchenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kitchen', [KitchenController::class, 'index']);

Route::post('/kitchen', [KitchenController::class, 'generateRecipe']);
