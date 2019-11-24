<?php

namespace App\Repositories\Educand;

use App\Models\Entities\Educand;
use Illuminate\Support\ServiceProvider;

class EducandRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Educand\EducandInterface', function($app) {
            return new EducandRepository(new Educand());
        });
    }
}