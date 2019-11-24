<?php

namespace App\Services\Station;

use \Illuminate\Support\Facades\Facade;

class StationFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘stationService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'stationService'; }

}