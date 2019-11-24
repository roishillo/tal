<?php

namespace App\Repositories\Track;

use App\Models\EducandTaskTrack;
use App\Models\Entities\Track;
use Illuminate\Support\ServiceProvider;

class TrackRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Track\TrackInterface', function($app) {
            return new TrackRepository(new Track(), new EducandTaskTrack());
        });
    }
}