<?php

use App\Http\Controllers\ProductsController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/product',[ProductsController::class,'store']);
Route::get('/products',[ProductsController::class,'show']);
Route::put('/product/{id}',[ProductsController::class,'update']);
Route::delete('/product/{id}',[ProductsController::class,'hapus']);