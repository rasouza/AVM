<?php

namespace App\Providers;

use Validator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('non_exists', 'App\Validators\FileValidator@nonExists');
        Validator::extend('operador_exists', 'App\Validators\FileValidator@operadorExists');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            $loader = AliasLoader::getInstance();
            $loader->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }
}
