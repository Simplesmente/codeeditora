<?php

namespace CodeEduUser\Providers;

use Illuminate\Support\ServiceProvider;
use CodeEduUser\Providers\AuthServiceProvider;

class CodeEduUserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrationAndSeeds();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

         //$reader = app(\CodeEduUser\Annotations\PermissionReader::class);
         //dd($reader->getPermissions());
         //dd($reader->getPermission(\CodeEduUser\Http\Controllers\UsersController::class));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Jrean\UserVerification\UserVerificationServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->registerAnnotations();
        
        $this->app->bind(\Doctrine\Common\Annotations\Reader::class,function(){
            return new \Doctrine\Common\Annotations\CachedReader(
                new \Doctrine\Common\Annotations\AnnotationReader,
                new \Doctrine\Common\Cache\FilesystemCache(storage_path('framework/cache/doctrine-annotations')),
                $debug = env('APP_DEBUG')
            );
        });
    }

    public function registerAnnotations()
    {
        $loader = require __DIR__ . '/../../../vendor/autoload.php';
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$loader,'loadClass']);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('codeeduuser.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'codeeduuser'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/codeeduuser');

        $sourcePath = __DIR__.'/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/codeeduuser';
        }, \Config::get('view.paths')), [$sourcePath]), 'codeeduuser');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/codeeduuser');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'codeeduuser');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../resources/lang', 'codeeduuser');
        }
    }

    public function registerMigrationAndSeeds()
    {

        $sourcePath = __DIR__ . '/../database/Migrations';
        
        $this->publishes([
            $sourcePath => database_path('migrations')
        ],'migrations');

        $sourcePath = __DIR__ . '/../database/seeders';
        
        $this->publishes([
            $sourcePath => database_path('seeds')
        ],'seeders');
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