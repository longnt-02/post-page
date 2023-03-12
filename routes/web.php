<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('', function(){
    return view('admin.home');
});


Route::middleware('checkadmin')->prefix('admin')->group(function() {
    Route::prefix('category')->group(function() {
        Route::get('', [CategoryController::class, 'index'])
            ->name('admin.category.index');

        Route::get('create', [CategoryController::class, 'create'])
            ->name('admin.category.create');

        Route::post('store', [CategoryController::class, 'store'])
            ->name('admin.category.store');

        Route::get('edit/{id}', [CategoryController::class, 'edit'])
            ->name('admin.category.edit');

        Route::put('update/{id}', [CategoryController::class, 'update'])
            ->name('admin.category.update');

        Route::get('delete/{id}', [CategoryController::class, 'delete'])
            ->name('admin.category.delete');
    });
    Route::prefix('user')->group(function() {
        Route::get('edit/{id}', [UserController::class, 'edit_administrators']);
        Route::put('update/{id}', [UserController::class, 'update_administrators']);
        Route::delete('delete/{id}', [UserController::class, 'delete_administrators']);
    });
    Route::prefix('post')->group(function() {
        Route::get('create', [UserController::class, 'create_administrators']);
        Route::post('store', [UserController::class, 'store_administrators']);
        Route::get('edit/{id}', [UserController::class, 'edit_administrators']);
        Route::put('update/{id}', [UserController::class, 'update_administrators']);
        Route::delete('delete/{id}', [UserController::class, 'delete_administrators']);
    });

    Route::post('logout', [UserController::class, 'logout']);
    Route::get('login_form', [UserController::class, 'login_form']);
    Route::get('login', [UserController::class, 'login']);
});

Route::prefix('user')->group(function() {
    Route::get('register', [UserController::class, 'create']);
    Route::post('create', [UserController::class, 'store']);
    Route::get('login_form', [UserController::class, 'login_form']);
    Route::get('login', [UserController::class, 'login'])
    ->name('user.login');
    // Route::post('authenticate', [UserController::class, 'authenticate']);
    Route::get('logout', [UserController::class, 'logout']);
});

Route::get('client', function(){
    return view('client.home');
});
