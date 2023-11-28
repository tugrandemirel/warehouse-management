<?php

use App\Http\Controllers\Admin\Entegration\Api\ApiController;
use App\Http\Controllers\Admin\Entegration\Store\StoreController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Warehouse\WarehouseController;
use App\Http\Controllers\Admin\Warehouse\WarehouseShelfController;
use App\Http\Controllers\Admin\Warehouse\WarehouseShelfGroupController;
use App\Http\Controllers\Admin\Settings\Product\CurrenyController;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('raf-grup')->as('shelfGroup.')->group(function (){
        Route::get('/', [WarehouseShelfGroupController::class, 'index'])->name('index');
        Route::get('/ekle', [WarehouseShelfGroupController::class, 'create'])->name('create');
        Route::post('/store', [WarehouseShelfGroupController::class, 'store'])->name('store');
        Route::get('/duzenle/{shelfGroup}', [WarehouseShelfGroupController::class, 'edit'])->name('edit');
        Route::post('/update/{shelfGroup}', [WarehouseShelfGroupController::class, 'update'])->name('update');
        Route::post('/destroy/{shelfGroup}', [WarehouseShelfGroupController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('raf')->as('warehouseShelf.')->group(function (){
        Route::get('/', [WarehouseShelfController::class, 'index'])->name('index');
        Route::get('/ekle', [WarehouseShelfController::class, 'create'])->name('create');
        Route::post('/store', [WarehouseShelfController::class, 'store'])->name('store');
        Route::get('/duzenle/{warehouseShelf}', [WarehouseShelfController::class, 'edit'])->name('edit');
        Route::post('/update/{warehouseShelf}', [WarehouseShelfController::class, 'update'])->name('update');
        Route::post('/destroy/{warehouseShelf}', [WarehouseShelfController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('ürün')->as('product.')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/ekle', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/duzenle/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::post('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('entegrasyon')->group(function (){
        Route::prefix('magaza')->as('store.')->group(function (){
            Route::get('/', [StoreController::class, 'index'])->name('index');
            Route::get('/ekle', [StoreController::class, 'create'])->name('create');
            Route::post('/store', [StoreController::class, 'store'])->name('store');
            Route::get('/duzenle/{store}', [StoreController::class, 'edit'])->name('edit');
            Route::post('/update/{store}', [StoreController::class, 'update'])->name('update');
            Route::post('/destroy/{store}', [StoreController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('api')->as('api.')->group(function (){
            Route::get('/', [ApiController::class, 'index'])->name('index');
            Route::get('/ekle', [ApiController::class, 'create'])->name('create');
            Route::post('/store', [ApiController::class, 'store'])->name('store');
            Route::get('/duzenle/{api}', [ApiController::class, 'edit'])->name('edit');
            Route::post('/update/{api}', [ApiController::class, 'update'])->name('update');
            Route::post('/destroy/{api}', [ApiController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('ayarlar')->as('settings.')->group(function (){
        Route::prefix('urun')->as('product.')->group(function (){
            Route::resourceVerbs([
                'create' => 'olustur',
                'edit' => 'duzenle',
            ]);
            Route::resource('para-birimi', CurrenyController::class)
                ->parameter('para-birimi', 'currency')
                ->except(['show'])
                ->names('currency');
        });
    });
});
