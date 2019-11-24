<?php

namespace App\Services\Station;

use App\Repositories\Station\StationInterface;
use App\Services\Admin\AdminFacade;
use Illuminate\Http\Request;

class StationService
{
    protected $stationRepo;

    public function __construct(StationInterface $stationRepo)
    {
        $this->stationRepo = $stationRepo;
    }
    public function get($stationId)
    {
        return $this->stationRepo->getById($stationId);
    }
    public function getStations()
    {
        $admin = AdminFacade::getLoggedInAdmin();
        return $this->stationRepo->getStations($admin);
    }
    public function getStationBySite($siteId)
    {
        return $this->stationRepo->getStationBySite($siteId);
    }
    public function saveStation(array $data, $siteId, $stationId = null)
    {
        $data['site_id'] = $siteId;
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        $data['is_active'] = array_get($data, 'is_active') == 'on';

        return $this->stationRepo->saveStation($data, $siteId, $stationId);
    }
    public function saveNewStation(array $data, $siteId, $stationId = null)
    {
        $data['site_id'] = $siteId;
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        $data['is_active'] = array_get($data, 'is_active') == 'on';

        return $this->stationRepo->saveStation($data, $siteId, $stationId);
    }
    public function sort($stationsArray, $siteId)
    {
        return $this->stationRepo->sort($stationsArray, $siteId);
    }

    public function validateStationRequest(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'is_active' => 'in:"on"|nullable',
            'is_public' => 'in:"on"|nullable',
            'preceding' =>'nullable',
            'visual_resource_path' =>'required'
        ]);

        return $validatedData;
    }

    public function getStationsWithTasks($siteId)
    {
        return $this->stationRepo->getStationsWithTasks($siteId);
    }
    public function delete(int $stationId)
    {
        $user = auth()->guard('admins')->user();
        return $this->stationRepo->deleteStation($stationId, $user);
    }
}
