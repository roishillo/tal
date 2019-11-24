<?php

namespace App\Repositories\Station;

interface StationInterface
{
    public function getById($stationId);

    public function getStationsWithTasks($stationId);

}