<?php

use App\Http\Controllers\ProductController;

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

Route::resource('/products',ProductController::class);


Route::get('/products/{id}/product-model',[ProductController::class, 'getProductModel']);
Route::post('/products/{id}/product-model',[ProductController::class, 'addProductModel']);
Route::put('/products/{id}/product-model', [ProductController::class, 'updateProductModel']);
Route::delete('/products/{id}/product-model', [ProductController::class, 'deleteProductModel']);
