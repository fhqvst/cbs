<?php

namespace App\Nordnet\Providers;

use Illuminate\Support\ServiceProvider;
use App\Instrument;
use App\Events\InstrumentUpdated;
use Event;
use Session;
use App\Nordnet\Nordnet;

class NordnetServiceProvider extends ServiceProvider
{

    protected $defer = true;

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
        $this->app->singleton('App\Nordnet\Contracts\NordnetContract', function() {
            return new Nordnet(
                config('nordnet.username'),
                config('nordnet.password')
            );
        });
    }

    public function provides() {
        return ['App\Nordnet\Contracts\NordnetContract'];
    }
}
