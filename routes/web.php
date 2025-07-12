<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\electricController;
use App\Http\Controllers\waterController;
use App\Http\Controllers\indexController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/readings', [indexController::class, 'index'])->name('index');

Route::resource('electric', electricController::class)->except(['show']);
Route::get('/electric/create', function () {
    return view('partials.electric.create');
})->name('electric.create');


Route::resource('water', waterController::class)->except(['show']);
Route::get('/water/create', function () {
    return view('partials.water.create');
})->name('water.create');
