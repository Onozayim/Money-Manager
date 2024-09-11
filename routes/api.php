<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('register', [AuthController::class, 'register']);
            Route::post('logout', [AuthController::class], 'logout');
            Route::post('me', [AuthController::class, 'me']);
        });

        Route::prefix('predict')->group(function() {
            Route::get('sub_category', [PredictController::class, 'predictSubcategory']);
        });

        Route::prefix('expense')->group(function() {
            Route::post('save', [ExpenseController::class, 'save']);
            Route::get('/', [ExpenseController::class, 'get']);
        });

        Route::prefix('user')->group(function() {
            Route::post('save_amount', [UserController::class, 'saveAmount']);
        });
    });
});
