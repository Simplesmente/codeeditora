<?php

namespace CodePub\Providers;

use Illuminate\Support\ServiceProvider;
use CodePub\Repositories\CategoryRepository;
use CodePub\Repositories\CategoryRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(\CodePub\Repositories\BookRepository::class, \CodePub\Repositories\BookRepositoryEloquent::class);
        //:end-bindings:
    }
}
