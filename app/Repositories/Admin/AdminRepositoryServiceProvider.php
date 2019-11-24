<?php

namespace App\Repositories\Admin;

use App\Models\Entities\Admin;
use Illuminate\Support\ServiceProvider;

class AdminRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Admin\AdminInterface', function($app) {
            return new AdminRepository(new Admin());
        });
    }
}