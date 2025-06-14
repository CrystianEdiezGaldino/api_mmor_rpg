<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\CharacterController;

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

Route::prefix('v1')->group(function () {
    Route::get('/accounts', [AccountController::class, 'index']);
    Route::post('/accounts', [AccountController::class, 'store']);
    Route::get('/accounts/login', [AccountController::class, 'checkEndpoint']);
    Route::post('/accounts/login', [AccountController::class, 'login']);

    Route::post('/characters', [CharacterController::class, 'store']);
    Route::get('/characters/{id}', [CharacterController::class, 'show']);
    Route::get('/accounts/{accountName}/characters', [CharacterController::class, 'listByAccount']);
});
