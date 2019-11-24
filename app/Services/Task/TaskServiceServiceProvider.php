<?php

namespace App\Services\Task;

use Illuminate\Support\ServiceProvider;

class TaskServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('taskService', function($app) {
            return new TaskService(
                $app->make('App\Repositories\Task\TaskInterface')
            );
        });
    }
}