<?php

use App\Http\Controllers\Rest\ProductController;
use App\Http\Controllers\Rest\RoleController;
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


Route::resource('/products',ProductController::class);
Route::get('/products/search/{name}',  [ProductController::class, 'search']);




// Route::get('/products',  [ProductController::class, 'index']);
// Route::post('/products', [ProductController::class, 'store']);

 //one-to-many relationship
 Route::post('/product-model/', [ProductController::class, 'addProductModel']);
 Route::get('/product-model', [ProductController::class, 'getProductModel']);
 Route::put('/product-model/{id}', [ProductController::class, 'updateProductModel']);
 Route::delete('/product-model/{id}', [ProductController::class, 'deleteProductModel']);


 //one-to-one relationship
 Route::post('/company/{id}', [ProductController::class, 'addCompany']);
 Route::get('/company/{id}', [ProductController::class, 'getCompanByProduct']);

 //many-to-many
 Route::get('/add-roles', [RoleController::class, 'addRole']);
 Route::get('/add-users', [RoleController::class, 'addUser']);
 Route::get('/rolesbyuser/{id}', [RoleController::class, 'getAllRolesByUser']);
 Route::get('/usersbyroles/{id}', [RoleController::class, 'getAllUsersByRole']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
