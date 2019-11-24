<?php

namespace App\Services\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('adminService', function($app) {
            return new AdminService(
                $app->make('App\Repositories\Admin\AdminInterface')
            );
        });
    }
}