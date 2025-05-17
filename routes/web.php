<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    ProfileController,
    CategoryController,
    CustomerController
};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::view('/dashboard', 'layouts.master')->name('dashboard');

    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Resource Routes
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'customers' => CustomerController::class,
    ]);
});


require __DIR__.'/auth.php';
