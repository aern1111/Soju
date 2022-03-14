<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use PharIo\Manifest\AuthorCollection;

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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Authen
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

//Product
Route::get('productRead',[ProductController::class,'productRead']);
Route::get('productReadTree',[ProductController::class,'productReadTree']);
Route::get('productReadID/{id}',[ProductController::class,'productReadID']);
Route::get('productSearch/{keyword}',[ProductController::class,'productSearch']);


Route::group(['middleware'=>'auth:sanctum'],function(){
    //Product(Token)
    Route::post('productCreate',[ProductController::class,'productCreate']);
    Route::put('productUpdate/{id}',[ProductController::class,'productUpdate']);
    Route::delete('productDelete/{id}',[ProductController::class,'productDelete']);
    Route::get('productCount',[ProductController::class,'productCount']);


    // User
    Route::get('userCount',[UserController::class,'userCount']);

    // Cart
    Route::get('productCartRead',[CartController::class,'productCartRead']);
    Route::post('productCartCreate',[CartController::class,'productCartCreate']);
    Route::delete('productCartDelete/{id}',[CartController::class,'productCartDelete']);
    Route::get('productCartCount',[CartController::class,'productCartCount']);

    //Authen(Token)
    Route::post('logout',[AuthController::class,'logout']);

});








