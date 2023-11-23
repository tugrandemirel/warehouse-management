<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Warehouse\WarehouseController;
use App\Http\Controllers\Admin\Warehouse\WarehouseShelfController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function (){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('kullanici')->as('user.')->group(function (){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/duzenle/{user}', [UserController::class, 'edit'])->name('edit');
        Route::post('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('depo')->as('warehouse.')->group(function (){
        Route::get('/', [WarehouseController::class, 'index'])->name('index');
        Route::get('/ekle', [WarehouseController::class, 'create'])->name('create');
        Route::post('/store', [WarehouseController::class, 'store'])->name('store');
        Route::get('/duzenle/{warehouse}', [WarehouseController::class, 'edit'])->name('edit');
        Route::post('/update/{warehouse}', [WarehouseController::class, 'update'])->name('update');
        Route::post('/destroy/{warehouse}', [WarehouseController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('raf')->as('warehouseShelf.')->group(function (){
        Route::get('/', [WarehouseShelfController::class, 'index'])->name('index');
        Route::get('/ekle', [WarehouseShelfController::class, 'create'])->name('create');
        Route::post('/store', [WarehouseShelfController::class, 'store'])->name('store');
        Route::get('/duzenle/{warehouseShelf}', [WarehouseShelfController::class, 'edit'])->name('edit');
        Route::post('/update/{warehouseShelf}', [WarehouseShelfController::class, 'update'])->name('update');
        Route::post('/destroy/{warehouseShelf}', [WarehouseShelfController::class, 'destroy'])->name('destroy');
    });

});
