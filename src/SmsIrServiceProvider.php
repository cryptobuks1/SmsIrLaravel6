<?php

namespace MahdiIDea\SmsIrLaravel6;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class SmsIrServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('smsIr', function () {
            return new SmsResolver();
        });
    }
}
