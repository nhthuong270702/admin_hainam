<?php

use App\Http\Controllers\Admin\OrderProduct\OrderProductController;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->as('admin.order-product.')
    ->group(function () {
        Route::controller(OrderProductController::class)
            ->group(function () {
                Route::get('/delete/order-product', 'delete')->name('delete');
                Route::get('/edit/order-product', 'edit')->name('edit');
                Route::post('/update/order-product', 'update')->name('update');
                Route::post('/create/order-product', 'create')->name('create');
            });
    });
