<?php

namespace App\Services\Track;

use Illuminate\Support\ServiceProvider;

class TrackServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('trackService', function($app) {
            return new TrackService(
                $app->make('App\Repositories\Track\TrackInterface')
            );
        });
    }
}