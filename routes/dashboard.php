<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RolesController;
use Illuminate\Support\Facades\Route;


Route::group([
        'middleware'=>['auth:admin'],
        'as'=>'dashboard.',
        'prefix'=>'admin/'
    ],function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile',[ProfileController::class,'update'])->name('profile.update');

    Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/forceDelete',[CategoriesController::class,'forceDelete'])->name('categories.forceDelete');
    Route::resource('/categories',CategoriesController::class);
    Route::resource('/admins',AdminsController::class);

    Route::resource('/products',ProductsController::class);
    Route::resource('/roles',RolesController::class);


    // Route::resource([
    //     // 'products'=>ProductsController::class,
    //     'categories'=>CategoriesController::class,
    //     'roles'=>RolesController::class
    // ]);

});
