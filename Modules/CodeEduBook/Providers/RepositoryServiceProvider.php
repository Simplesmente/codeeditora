<?php

namespace CodeEduBook\Providers;

use Illuminate\Support\ServiceProvider;

use CodeEduBook\Repositories\CategoryRepository;
use CodeEduBook\Repositories\CategoryRepositoryEloquent;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\BookRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(BookRepository::class, BookRepositoryEloquent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
