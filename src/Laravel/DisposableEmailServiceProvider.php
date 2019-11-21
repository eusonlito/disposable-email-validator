<?php
namespace Eusonlito\DisposableEmail\Laravel;

use Eusonlito\DisposableEmail\Check;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class DisposableEmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        /*
         * Added a custom validator filter.
         */
        $check = function ($attr, $value) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) && Check::domain(explode('@', $value, 2)[1]);
        };

        Validator::extend('disposable_email', $check, 'The :attribute domain is not allowed.');
    }
}
