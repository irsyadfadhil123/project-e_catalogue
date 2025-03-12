<?php

use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('product', ProductsController::class)->names([
    'index' => 'product.index',
    'create' => 'product.create',
    'store' => 'product.store',
    'edit' => 'product.edit',
    'destroy' => 'product.destroy',
]);
