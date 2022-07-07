<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*
*/

//Rutas no protegidas por middleware
Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'authenticate']);
Route::post('logout', [UserController::class,'logout']);


//Rutas protegidas por middleware
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('products' , [ProductController::class,'index']);
    Route::get('products/{product}' , [ProductController::class,'show']);
    Route::post('products' , [ProductController::class,'store']);
    Route::put('products/{product}' , [ProductController::class,'update']);
    Route::delete('products/{product}' , [ProductController::class,'delete']);
    //Rutas de Usuarios
    Route::get('user', [UserController::class,'getAuthenticatedUser']);
    Route::get('users' , [UserController::class,'showU']);
    Route::put('users/{user}' , [UserController::class,'updateU']);
    Route::delete('users/{user}' , [UserController::class,'deleteU']);
    Route::post('logout', [UserController::class,'logout']);
    //Rutas de Roles
    Route::get('roles' , [RoleController::class,'index']);
    Route::get('roles/{role}' , [RoleController::class,'show']);
    Route::post('roles' , [RoleController::class,'store']);
    Route::put('roles/{role}' , [RoleController::class,'update']);
    Route::delete('roles/{role}' , [RoleController::class,'delete']);

});


