<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\PostStatusController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Worker\AuthWorkerController;
use App\Http\Controllers\Worker\WorkerReviewController;
use App\Http\Controllers\Worker\WorkerProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



Route::controller(AuthAdminController::class)
    ->prefix('auth/admin')
    ->group(function ()
    {
    Route::post('/login', 'login');
    Route::post('/register','register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile' , 'userProfile');
    }
);


Route::controller(ClientAuthController::class)
    ->prefix('auth/client')
    ->group(function ()
    {
    Route::post('/login', 'login');
    Route::post('/register','register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile' , 'userProfile');
    }
);


Route::controller(AuthWorkerController::class)
    ->prefix('auth/worker')
    ->group(function ()
    {
    Route::post('/login', 'login');
    Route::post('/register','register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile' , 'userProfile');
    }
);

Route::controller(PostController::class)
    ->prefix('worker/post')
    ->group(function ()
    {
    Route::post('/add', 'store')->middleware('auth:worker');
    Route::get('/shwAll', 'index')->middleware('auth:admin');
    Route::get('/Post-approved', 'approved')->middleware('auth:admin');


    }
);

Route::prefix('admin/post')->group(function (){
    Route::post('/changeStatus',[PostStatusController::class,'changeStatus']);
    Route::get('/get-Won_post/{id}',[PostController::class,'show']);
});

Route::controller(AdminNotificationController::class)
    ->middleware('auth:admin')
    ->prefix('admin/notifications')
    ->group(function ()
    {
    Route::get('/all', 'index');
    Route::get('/unread', 'unread');
    Route::get('/markRead', 'markReadAll');
    Route::delete('/deleteAll', 'deleteAll');
    Route::delete('/delete/{id}', 'delete');

    }
);

Route::prefix('client')->group(function () {
    Route::controller(ClientOrderController::class)->prefix('/order')->group(function () {
        Route::post('/request', 'addOrder')->middleware('auth:client');
        Route::get('/approved', 'approvedOrders')->middleware('auth:client');
    });
});
Route::prefix('worker')->middleware('auth:worker')->group(function () {

    Route::get('export', [FileController::class, 'export']);
    Route::post('import', [FileController::class, 'import']);
    Route::get('pendeing/orders', [ClientOrderController::class, 'workerOrder']);
    Route::put('update/order/{id}', [ClientOrderController::class, 'update']);
    Route::get('/review/post/{postId}', [WorkerReviewController::class, 'postRate']);
    Route::get('/profile', [WorkerProfileController::class, 'userProfile']);
    Route::get('/profile/edit', [WorkerProfileController::class, 'edit']);
    Route::post('/profile/update', [WorkerProfileController::class, 'update']);
    Route::delete('/profile/posts/delete', [WorkerProfileController::class, 'delete']);
});

//All
Route::post('client/review', [WorkerReviewController::class, 'store'])->middleware('auth:client');
Route::get('client/Post/approved', [PostController::class, 'approved']);


Route::get('/unauthorized', function () {
    return response()->json([
        "message" => "Unauthorized"
    ], 401);
})->name('login');


