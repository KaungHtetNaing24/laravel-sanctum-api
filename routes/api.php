<?php

use App\Http\Controllers\ProductController; 
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


Route::resource('products',ProductController::class);
Route::get('/products/search/{name}',  [ProductController::class, 'search']);



// Route::get('/products',  [ProductController::class, 'index']);
// Route::post('/products', [ProductController::class, 'store']);

 //one-to-many relationship
 Route::post('/add-productModel/{id}', [ProductController::class, 'addProductModel']);
 Route::get('/get-productModelById/{id}', [ProductController::class, 'getProductModelById']);
 Route::put('/update-productModel/{id}', [ProductController::class, 'updateProductModel']);
 Route::delete('/delete-productModel/{id}', [ProductController::class, 'deleteProductModel']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
