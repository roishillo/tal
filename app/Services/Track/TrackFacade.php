<?php

namespace App\Services\Track;

use \Illuminate\Support\Facades\Facade;

class TrackFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘trackService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'trackService'; }

}