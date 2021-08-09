<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    	$this->app->singleton(
            \App\Helpers\Json::class, 
            \App\Helpers\ResponseHelper::class
        );
        $this->app->when(\App\Http\Controllers\States\IndexController::class)
                ->needs(\App\Repositories\Readable::class)
                ->give(\App\Repositories\StateRepository::class);
        $this->app->when(\App\Http\Controllers\States\ShowController::class)
                ->needs(\App\Repositories\Readable::class)
                ->give(\App\Repositories\StateRepository::class);
        $this->app->when(\App\Http\Controllers\Users\IndexController::class)
                ->needs(\App\Repositories\Readable::class)
                ->give(\App\Repositories\UserRepository::class);
        $this->app->when(\App\Http\Controllers\Users\ShowController::class)
                ->needs(\App\Repositories\Readable::class)
                ->give(\App\Repositories\UserRepository::class);
        
        $this->app->when(\App\Http\Controllers\Users\StoreController::class)
                ->needs(\App\Repositories\Writetable::class)
                ->give(\App\Repositories\UserRepository::class);
        $this->app->when(\App\Http\Controllers\Users\UpdateController::class)
                ->needs(\App\Repositories\Writetable::class)
                ->give(\App\Repositories\UserRepository::class);
        $this->app->when(\App\Http\Controllers\Users\DeleteController::class)
                ->needs(\App\Repositories\Writetable::class)
                ->give(\App\Repositories\UserRepository::class);

        $this->app->singleton(
           \App\Repositories\Auth::class,
           \App\Repositories\AuthRepository::class
        );
    }
}