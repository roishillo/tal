<?php

namespace App\Http\Controllers\Admin\Stations;

use App\Http\Controllers\Controller;
use App\Models\Entities\Site;
use App\Services\Site\SiteFacade;
use App\Services\Station\StationFacade;
use Illuminate\Http\Request;


class StationController extends Controller
{
    public function showSitesStations($siteId)
    {
        $stations = StationFacade::getStationsWithTasks($siteId);
        $predictedNumOfStations = SiteFacade::getPredictedNumberOfStations($siteId);
        return view('admin.sites-management.stations', compact('stations','predictedNumOfStations','siteId'));
    }
    public function createStation($siteId)
    {
        $stations = StationFacade::getStationBySite($siteId);
        return view('admin.sites-management.createStation', compact('siteId','stations'));
    }
    public function editStation($siteId, $stationId)
    {
        $station = StationFacade::get($stationId);
        $stations = StationFacade::getStationBySite($siteId);
        return view('admin.sites-management.createStation', compact('siteId','station', 'stations'));
    }
    public function saveStation(Request $request, $siteId, $stationId = null)
    {
        $admin = auth()->guard('admins')->user();

        if ($admin->id == Site::find($siteId)->admin_id ||  Site::find($siteId)->is_public || $admin->role === 'Admin') {

            $validatedData = StationFacade::validateStationRequest($request);

           $saved =  StationFacade::saveStation($validatedData, $siteId, $stationId);

           if($saved) {
               toastr([
                   'type' => 'success',
                   'message' => 'station saved'
               ]);

               return redirect()->route('admin.sites-management.show-stations', compact('siteId'));
           } else {
               toastr([
                   'type' => 'error',
                   'message' => 'station not saved'
               ]);

               return back();
           }
        } else {
            toastr([
                'type' => 'error',
                'message' => 'Action not allowed'
            ]);

            return back();
        }
    }
    public function saveNewStation(Request $request, $siteId, $stationId = null)
    {
        $admin = auth()->guard('admins')->user();
        if ($admin->id == Site::find($siteId)->admin_id || $admin->role === 'Admin') {

            $validatedData = StationFacade::validateStationRequest($request);

            $saved =  StationFacade::saveNewStation($validatedData, $siteId, $stationId);

            if($saved) {
                toastr([
                    'type' => 'success',
                    'message' => 'New station Created'
                ]);

                return redirect()->route('admin.sites-management.show-stations', compact('siteId'));
            } else {
                toastr([
                    'type' => 'error',
                    'message' => 'station not saved'
                ]);

                return back();
            }
        } else {
            toastr([
                'type' => 'error',
                'message' => 'wrong credentials'
            ]);

            return back();
        }
    }
    public function sortStations(Request $request, $siteId)
    {

       return StationFacade::sort($request->request, $siteId);

    }
    public function deleteStation($siteId, $stationId)
    {

        $deleted = StationFacade::delete($stationId);

        if($deleted){

            return back();
        } else {
            toastr([
                'type' => 'error',
                'message' => 'station not deleted'
            ]);
        }
    }

    public function getStations(Request $request)
    {
        return $stations = StationFacade::getStationBySite($request->id);
    }
}
