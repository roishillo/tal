<?php

namespace App\Services\Admin;

use \Illuminate\Support\Facades\Facade;

class AdminFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘adminService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'adminService'; }

}