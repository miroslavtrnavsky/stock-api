<?php

use Http\Controllers\Api\PackageController;
use Http\Controllers\Api\StockController;
use Illuminate\Support\Facades\Route;
use Http\Controllers\Api\AuthController;

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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum'], 'namespace' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/reset-password', [AuthController::class, 'changePassword']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'stocks'], function () {
        Route::get('/', [StockController::class, 'index']);
        Route::post('/', [StockController::class, 'create']);
        Route::post('/{id}', [StockController::class, 'update']);
        Route::get('/{id}', [StockController::class, 'find']);
        Route::delete('/{id}', [StockController::class, 'find']);
    });

    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', [PackageController::class, 'index']);
        Route::post('/', [PackageController::class, 'create']);
        Route::post('/{id}', [PackageController::class, 'update']);
        Route::get('/{id}', [PackageController::class, 'find']);
        Route::delete('/{id}', [PackageController::class, 'find']);
    });
});
