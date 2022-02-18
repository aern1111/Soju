<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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
Route::get('productReadID/{id}',[ProductController::class,'productReadID']);



Route::group(['middleware'=>'auth:sanctum'],function(){
    //Product(Token)
    Route::post('productCreate',[ProductController::class,'productCreate']);
    Route::put('productUpdate/{id}',[ProductController::class,'productUpdate']);
    Route::delete('productDelete/{id}',[ProductController::class,'productDelete']);
    
    //Authen(Token)
    Route::post('logout',[AuthController::class,'logout']);

});








