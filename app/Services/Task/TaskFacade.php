<?php

namespace App\Services\Task;

use \Illuminate\Support\Facades\Facade;

class TaskFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘taskService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'taskService'; }

}