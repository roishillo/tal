<?php

namespace App\Repositories\Task;

use App\Models\Entities\Task;
use Illuminate\Support\ServiceProvider;

class TaskRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Task\TaskInterface', function($app) {
            return new TaskRepository(new Task());
        });
    }
}