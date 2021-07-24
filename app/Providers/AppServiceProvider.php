<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    	$this->app->singleton(
            \App\Jobs\ResponseJobInterface::class, 
            \App\Jobs\ResponseJob::class
        );
        $this->app->when(\App\Http\Controllers\States\IndexController::class)
                ->needs(\App\Repositories\RepositoryInterface::class)
                ->give(\App\Repositories\StateRepository::class);
        $this->app->when(\App\Http\Controllers\Users\IndexController::class)
                ->needs(\App\Repositories\RepositoryInterface::class)
                ->give(\App\Repositories\UserRepository::class);
            
    }
}