<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExchangeRateController;
//use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\LoginController;
/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "api" middleware group. Make something great!
 * |
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    
//Route::post('login', [AuthController::class, 'login']);
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    //Route::post('logout', [AuthController::class, 'logout']);
    Route::post('logout', [LoginController::class, 'logout']);
    
    Route::get('exchangerate/{date}', [ExchangeRateController::class, 'index']);
    Route::get('exchangerate/{date}/{currency}', [ExchangeRateController::class, 'index']);
    
    Route::post('exchangerate', [ExchangeRateController::class, 'store']);
});

//Route::apiResource('exchangerate/{date}', [ExchangeRateController::class, 'index'])->middleware('auth:sanctum');
//Route::apiResource('exchangerate/{date}/{currency}', [ExchangeRateController::class, 'index'])->middleware('auth:sanctum');

//Route::post('exchangerate', 'ExchangeRateController@store');
