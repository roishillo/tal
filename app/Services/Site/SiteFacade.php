<?php

namespace App\Services\Site;

use \Illuminate\Support\Facades\Facade;

class SiteFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘siteService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'siteService'; }

}