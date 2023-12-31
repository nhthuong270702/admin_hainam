<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\ImportProduct\ImportProductController;
use App\Http\Controllers\Admin\ExportProduct\ExportProductController;
use App\Http\Controllers\Admin\AdminController\AdminController;
use App\Http\Controllers\Admin\StatisticalController\StatisticalController;

// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |


Route::controller(AuthController::class)
    ->group(function () {
        Route::as('login.')
            ->group(function () {
                Route::get('/', 'getLogin')->name('create');
                Route::post('/', 'postLogin')->name('store');
            });

        Route::get('/logout', 'logout')->name('logout');
    });

Route::prefix('admin')->as('admin.')
    ->middleware('check-login')
    ->group(function () {
        Route::controller(AdminController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
        Route::controller(StatisticalController::class)
            ->prefix('/statistical')->as('statistical.')
            ->group(function () {
                Route::get('/', 'index')->name('list');
                Route::get('/search', 'search')->name('search');
            });
        Route::controller(ExportProductController::class)
            ->prefix('/export-products')->as('export-product.')
            ->group(function () {
                Route::get('/', 'index')->name('list');
                Route::get('/search-exp', 'search')->name('search');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{id}', 'edit')->name('edit');
                Route::post('/{id}', 'update')->name('update');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });
        Route::controller(ImportProductController::class)
            ->prefix('/import-products')->as('import-product.')
            ->group(function () {
                Route::get('/', 'index')->name('list');
                Route::get('/search-imp', 'search')->name('search');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{id}', 'edit')->name('edit');
                Route::post('/{id}', 'update')->name('update');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });
        Route::controller(ProductController::class)
            ->prefix('/products')->as('product.')
            ->group(function () {
                Route::get('/search-pro', 'search')->name('search');
                Route::get('/', 'index')->name('list');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::post('/store-product', 'storeProduct')->name('store-product');
                Route::get('/{id}', 'edit')->name('edit');
                Route::post('/{id}', 'update')->name('update');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });
    });
