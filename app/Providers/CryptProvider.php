<?php

namespace App\Providers;

use App\Crypt\Crypt;
use App\Crypt\Openssl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CryptProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Crypt::class, function() {
            return new Openssl();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
