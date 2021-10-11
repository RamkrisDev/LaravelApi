<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userapi;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Devicepost;
use App\Http\Controllers\MemberController;
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
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::apiResource("member",MemberController::class);

    });
Route::get('data',[userapi::class,'getdata']);


Route::get('list',[DeviceController::class,'list']);

Route::get('listid/{id?}',[DeviceController::class,'listid']);

Route::post("add",[Devicepost::class,'add']);

Route::put("upd",[Devicepost::class,'upd']);

Route::get("search/{name}",[Devicepost::class,'search']);

Route::delete("delete/{id}",[Devicepost::class,'delete']);

//test api
Route::post("save",[Devicepost::class,'testapp']);

// Route::apiResource("member",MemberController::class);

Route::get("login",[UserController::class,'index']);




//new practice
use App\Http\Controllers\PostController;
// Route::get('posts',[PostController::class,'index']);
// Route::post('post',[PostController::class,'store']);
// Route::get('posts/{id}',[PostController::class,'show']);
// Route::put('posts/{id}',[PostController::class,'update']);
// Route::delete('posts/{id}',[PostController::class,'destroy']);

use App\Http\Controllers\AuthController;
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::get('posts',[PostController::class,'index']);
    Route::post('post',[PostController::class,'store']);
    Route::get('posts/{id}',[PostController::class,'show']);
    Route::put('posts/{id}',[PostController::class,'update']);
    Route::delete('posts/{id}',[PostController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout']);
});