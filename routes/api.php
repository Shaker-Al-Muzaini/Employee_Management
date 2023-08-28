<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Worker\WorkerController;
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
Route::group([
    'prefix' => 'auth/admin'
], function ($router) {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::post('/refresh', [AdminController::class, 'refresh']);
    Route::get('/user-profile', [AdminController::class, 'userProfile']);
});


Route::group([
    'prefix' => 'auth/client',
], function ($router) {
    Route::post('/login', [ClientAuthController::class, 'login']);
    Route::post('/register', [ClientAuthController::class, 'register']);
    Route::post('/logout', [ClientAuthController::class, 'logout']);
    Route::post('/refresh', [ClientAuthController::class, 'refresh']);
    Route::get('/user-profile', [ClientAuthController::class, 'userProfile']);
});


Route::group([
    'prefix' => 'auth/worker',
], function ($router) {
    Route::post('/login', [WorkerController::class, 'login']);
    Route::post('/register', [WorkerController::class, 'register']);
    Route::post('/logout', [WorkerController::class, 'logout']);
    Route::post('/refresh', [WorkerController::class, 'refresh']);
    Route::get('/user-profile', [WorkerController::class, 'userProfile']);
});


