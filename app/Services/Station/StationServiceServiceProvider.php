<?php

namespace App\Services\Station;

use Illuminate\Support\ServiceProvider;

class StationServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('stationService', function($app) {
            return new StationService(
                $app->make('App\Repositories\Station\StationInterface')
            );
        });
    }
}