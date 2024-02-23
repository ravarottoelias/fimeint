<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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


        Blade::directive('truncateString', function ($expression) {
            eval("\$params = $expression;");
            list($string, $length) = $params;
        
            return "<?php echo mb_strimwidth($string, 0, $length, '...') ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
