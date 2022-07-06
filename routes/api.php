<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Rutas no protegidas por middleware
Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'authenticate']);


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
});
