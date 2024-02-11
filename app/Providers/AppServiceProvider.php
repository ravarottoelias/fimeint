<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('recaptcha','App\\Validators\\ReCaptcha@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\UserRepositoryInterface','App\Repositories\UserRepository');
        $this->app->bind('App\Interfaces\CursoRepositoryInterface','App\Repositories\CursoRepository');
        $this->app->bind('App\Interfaces\InscriptionRepositoryInterface','App\Repositories\InscriptionRepository');
        $this->app->bind('App\Interfaces\MercadoPagoIntegrationInterface','App\Repositories\MercadoPagoIntegration');
    }
}
