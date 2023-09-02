<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\PostStatusController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Worker\AuthWorkerController;
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





//Route::get('/unauthorized', function () {
//    return response()->json([
//        "message" => "Unauthorized"
//    ], 401);
//})->name('login');
//

