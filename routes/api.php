<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsumedController;
use App\Http\Controllers\Api\DrinkController;
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

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'excluded_middleware' => ['auth:api'],
], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::apiResource('drinks', DrinkController::class);
Route::post('/drinks/populate', [DrinkController::class, 'populate'])->name('drinks.populate');

Route::apiResource('consumed', ConsumedController::class);


