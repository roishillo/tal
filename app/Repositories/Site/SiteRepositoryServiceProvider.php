<?php

namespace App\Repositories\Site;

use App\Models\Entities\Site;
use Illuminate\Support\ServiceProvider;

class SiteRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Site\SiteInterface', function($app) {
            return new SiteRepository(new Site());
        });
    }
}