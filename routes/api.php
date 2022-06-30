<?php
Use App\Models\Product;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('products', function() {
return Product::all();
});

Route::get('products/{id}', function($id) {
return Product::find($id);
});

Route::post('products', function(Request $request) {
return Product::create($request->all());
});

Route::put('products/{id}', function(Request $request, $id) {
    $product = Product::findOrFail($id);
    $product->update($request->all());
return $product;
});

Route::delete('products/{id}', function($id) {
Product::find($id)->delete();
return 204;
});
