<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\LinkController;
use App\Http\Controllers\v1\AccountantController;
use App\Http\Controllers\v1\UseraccessesController;

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

    Route::prefix('links')->group(function () {
        Route::get('/', [LinkController::class, 'index']);
        Route::get('/total-clicks', [LinkController::class, 'totalClicks']);
        Route::get('/{uuid}', [LinkController::class, 'show']);
        Route::get('/{uuid}/details', [LinkController::class, 'details']);
        Route::post('/', [LinkController::class, 'store']);
        Route::put('/{uuid}', [LinkController::class, 'update']);
        Route::delete('/{uuid}', [LinkController::class, 'delete']);
        Route::get('/trash', [LinkController::class, 'trash']);
        Route::get('/trash{uuid}', [LinkController::class, 'restore']);
    });

    Route::prefix('accountants')->group(function () {
        Route::get('/', [AccountantController::class, 'index']);
    });

    Route::prefix('useraccesses')->group(function () {
        Route::get('/', [UseraccessesController::class, 'index']);
    });
});
