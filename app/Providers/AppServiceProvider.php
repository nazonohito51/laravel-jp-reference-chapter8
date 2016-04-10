<?php

namespace App\Providers;

use App\DataAccess\Cache\DataCache;
use App\Http\Validators\CustomValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->resolver(function($translator, $data, $rules, $message) {
            return new CustomValidator($translator, $data, $rules, $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\EntryRepositoryInterface::class,
            function($app) {
                return new \App\Repositories\EntryRepository(
                    new \App\DataAccess\Eloquent\Entry,
                    new DataCache($app['cache'], 'entry', 120)
                );
            }
        );
        $this->app->bind(
            \App\Repositories\CommentRepositoryInterface::class,
            function ($app) {
                return new \App\Repositories\CommentRepository(
                    new \App\DataAccess\Eloquent\Comment,
                    new DataCache($app['cache'], 'comment', 120)
                );
            }
        );
    }
}
