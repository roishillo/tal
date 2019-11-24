<?php

namespace App\Services\Site;

use Illuminate\Support\ServiceProvider;

class SiteServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('siteService', function($app) {
            return new SiteService(
                $app->make('App\Repositories\Site\SiteInterface')
            );
        });
    }
}