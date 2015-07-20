<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Instrument;
use App\Events\InstrumentUpdated;
use Event;

class NordnetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Instrument::updated(function($instrument) {
            Event::fire(new InstrumentUpdated($instrument));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
