<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    CategoryController,
    CustomerController
};

Route::get('/', function () {
    return view('layouts.master');
})->name('home');

// Resource routes
Route::group(['middleware' => ['web']], function () {
    Route::resources([
        'categories' => CategoryController::class,
        'products'   => ProductController::class,
        'customers'  => CustomerController::class
    ]);
});