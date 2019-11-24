<?php

namespace App\Repositories\Station;

use App\Models\Entities\Station;
use Illuminate\Support\ServiceProvider;

class StationRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Station\StationInterface', function($app) {
            return new StationRepository(new Station());
        });
    }
}