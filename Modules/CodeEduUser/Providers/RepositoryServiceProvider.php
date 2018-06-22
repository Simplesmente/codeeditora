<?php

namespace CodeEduUser\Providers;

use Illuminate\Support\ServiceProvider;
use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Repositories\UserRepositoryEloquent;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Repositories\PermissionRepositoryEloquent;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\RoleRepositoryEloquent;

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
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(PermissionRepository::class, PermissionRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
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
