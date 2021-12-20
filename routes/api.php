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

    Route::apiResources([
        'stocks' => StockController::class,
        'packages' => PackageController::class,
    ]);
});
