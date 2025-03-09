<?php

use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/add', function () {
    return view('add');
});

Route::get('/catalogue', [CatalogueController::class, 'index']);
