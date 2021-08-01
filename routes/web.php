<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\RoleController;
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

Auth::routes();



Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
    Route::get('/normal_users', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users',[UserController::class, 'index']);
    Route::get('/users/{id}/edit',[UserController::class, 'edit']);
    Route::post('/users/{id}/update',[UserController::class, 'update']);
    
    Route::get('/managers',[ManagerController::class, 'index']);
    Route::get('/supervisors',[SupervisorController::class, 'index']);
    Route::get('/staffs',[StaffController::class, 'index']);
    Route::get('/roles',[RoleController::class, 'index']);
});
