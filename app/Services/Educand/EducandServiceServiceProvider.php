<?php

namespace App\Services\Educand;

use Illuminate\Support\ServiceProvider;

class EducandServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('educandService', function($app) {
            return new EducandService(
                $app->make('App\Repositories\Educand\EducandInterface')
            );
        });
    }
}