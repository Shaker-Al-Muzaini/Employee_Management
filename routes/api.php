<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Worker\AuthWorkerController;
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
Route::controller(AuthAdminController::class)->prefix('auth/admin')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register','register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile' , 'userProfile');
});


Route::controller(ClientAuthController::class)->prefix('auth/client')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register','register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile' , 'userProfile');
});


Route::controller(AuthWorkerController::class)->prefix('auth/worker')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register','register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile' , 'userProfile');
});



