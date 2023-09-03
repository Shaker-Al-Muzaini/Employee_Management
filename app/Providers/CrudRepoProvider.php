<?php

namespace App\Providers;

use App\Http\Controllers\Client\ClientOrderController;
use App\Interfaces\CrudRepoInterfaceInterface;
use App\Repository\ClientOrderRepo;
use Illuminate\Support\ServiceProvider;

class CrudRepoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
     $this->app->when(ClientOrderController::class)
         ->needs(CrudRepoInterfaceInterface::class)
         ->give(function (){
             return new ClientOrderRepo();
         });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
