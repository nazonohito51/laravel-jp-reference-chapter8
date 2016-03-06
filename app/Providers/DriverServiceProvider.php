<?php

namespace App\Providers;

use App\Authenticate\UserCacheProvider;
use Illuminate\Support\ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['auth']->extend('auth_cache', function() {
            $model = $this->app['config']['auth.model'];
            return new UserCacheProvider(
                $this->app['hash'], $model, $this->app['cache.store']
            );
        });
    }

    public function register()
    {

    }
}