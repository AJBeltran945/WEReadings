<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\electricController;
use App\Http\Controllers\waterController;

Route::get('/', function () {
    return view('home');
});

Route::resource('electric', electricController::class)->except(['show']);
Route::get('/electric/create', function () {
    return view('partials.electric.create');
})->name('electric.create');


Route::resource('water', waterController::class)->except(['show']);
Route::get('/water/create', function () {
    return view('partials.water.create');
})->name('water.create');
