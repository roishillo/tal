<?php

namespace App\Services\Educand;

use \Illuminate\Support\Facades\Facade;

class EducandFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘educandService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'educandService'; }

}