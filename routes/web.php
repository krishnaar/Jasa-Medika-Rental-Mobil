<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\RentCarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get( '/', [ AuthController::class, 'index'] )->name('auth.signin');

 Route::group( ['prefix' => 'auth', ], function() {
    Route::get( '/login', [ AuthController::class, 'index'] )->name('auth.signin');
    Route::get( '/register', [ AuthController::class, 'register'] )->name('auth.register');
    Route::post( '/post', [ AuthController::class, 'post'] )->name('auth.post');
    Route::post( '/postRegister', [ AuthController::class, 'postRegister'] )->name('auth.register.post');
    Route::get( '/logout', [ AuthController::class, 'logout'] )->name('auth.logout');
});

Route::group( ['prefix' => 'admin', 'namespace' => 'Backend'], function() {
     

    Route::group( [  'middleware'=>['auth', 'admin']], function() {
        
        Route::group( ['prefix' => 'dashboard', ], function() {
            Route::get( '/', [  DashboardController::class, 'index'] )->name('admin.dahsboard.index');
        });

        Route::group( ['prefix' => 'user'], function()  {
            Route::get( '/' , [  UserController::class, 'index' ])->name('admin.user.index');
        });

        Route::group( ['prefix' => 'car'], function()  {
            Route::get( '/' , [  CarController::class, 'index' ])->name('admin.car.index');
            Route::get( 'create' , [  CarController::class, 'create' ])->name('admin.car.create');
            Route::post( 'store' , [  CarController::class, 'store' ])->name('admin.car.store');
            Route::get( 'edit/{id}' , [  CarController::class, 'edit' ])->name('admin.car.edit');
            Route::get( 'detail/{id}' , [  CarController::class, 'detail' ])->name('admin.car.detail');
            Route::post( 'rent/{id}' , [  CarController::class, 'rent' ])->name('admin.car.rent');
            Route::put( 'update/{id}' , [  CarController::class, 'update' ])->name('admin.car.update');
            Route::delete( 'destroy/{id}' , [  CarController::class, 'destroy' ])->name('admin.car.destroy');
        });

        Route::group( ['prefix' => 'rentcar'], function()  {
            Route::get( '/' , [  RentCarController::class, 'index' ])->name('admin.rentcar.index');
            Route::put( 'update/{id}' , [  RentCarController::class, 'update' ])->name('admin.rentcar.update');
        });
        
    });
    
});

Route::group( ['prefix' => 'user', 'namespace' => 'Backend'], function() {
     

    Route::group( [  'middleware'=>['auth', 'user']], function() {
        
        Route::group( ['prefix' => 'car'], function()  {
            Route::get( '/' , [  CarController::class, 'index' ])->name('user.car.index');
            Route::get( 'detail/{id}' , [  CarController::class, 'detail' ])->name('user.car.detail');
            Route::post( 'rent/{id}' , [  CarController::class, 'rent' ])->name('user.car.rent');
        });

        Route::group( ['prefix' => 'rentcar'], function()  {
            Route::get( '/' , [  RentCarController::class, 'index' ])->name('user.rentcar.index');
            Route::put( 'update/{id}' , [  RentCarController::class, 'update' ])->name('user.rentcar.update');
        });
        
    });
    
});