<?php

namespace App\Repositories\Station;


use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\ParentActiveScope;
use Illuminate\Database\Eloquent\Model;

class StationRepository implements StationInterface
{
    protected $stationModel;

    public function __construct(Model $station)
    {
        $this->stationModel = $station;
    }

    public function getById($stationId)
    {
        return $this->stationModel->find($stationId);
    }
    public function getStations($admin)
    {
        if($admin->role === "Admin") {
            $stations = $this->stationModel
                ->get();
        } else {
            $stations = $this->stationModel->where('admin_id', $admin->id)
                ->orWhere(function ($query) {
                    $query->where('is_public', true)
                        ->where('is_active', true);
                })
                ->withoutGlobalScopes()
                ->get();
        }
        return $stations;
    }
    public function getStationBySite($siteId)
    {
        return $this->stationModel->where('site_id', $siteId)->orderBy('order')->get();

    }
    public function saveStation(array $stationData, $siteId ,int $stationId = null)
    {
        if(isset($stationData['preceding'])) {
            $x = $this->stationModel->newQueryWithoutScope(ActiveScope::class)->where('id', $stationData['preceding'])->first(['order'])->order;
        } else {
            $x = 0;
        }
        $this->stationModel->newQueryWithoutScopes([ActiveScope::class, ParentActiveScope::class])->where('site_id',$siteId)->where('order', '>', $x)->increment('order');
        $stationData['order'] = $x+1;
        return $this->stationModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $stationId], $stationData);

    }
    public function saveNewStation(array $stationData, $siteId ,int $stationId = null)
    {
        if(isset($stationData['preceding'])) {
            $x = $this->stationModel->newQueryWithoutScope(ActiveScope::class)->where('id', $stationData['preceding'])->first(['order'])->order;
        } else {
            $x = 0;
        }
        $this->stationModel->newQueryWithoutScopes([ActiveScope::class, ParentActiveScope::class])->where('site_id',$siteId)->where('order', '>', $x)->increment('order');
        $stationData['order'] = $x+1;
        return $this->stationModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $stationId], $stationData);

    }

    public function sort($positionsArray, $siteId)
    {

        $positions  = $positionsArray->all();

        $orderArray = array();
       foreach(array_keys($positions) as $key){
           $id = explode('-',$key)[1];
           $data['id'] = $id;
           $data['order'] = (array_search($key,array_keys($positions))+1);
           array_push($orderArray,$data);
    }


        for ($i = 0; $i < sizeof($orderArray); $i++) {
            $this->stationModel->newQueryWithoutScope(ActiveScope::class)->where('site_id', $siteId)->where('id', $orderArray[$i]['id'])->update(['order' => $orderArray[$i]['order']]);
        }

        return $this->stationModel->newQueryWithoutScope(ActiveScope::class)->where('site_id', $siteId)->pluck('order');
    }

    public function getStationsWithTasks($siteId)
    {
        return $this->stationModel->newQueryWithoutScopes([ActiveScope::class, ParentActiveScope::class])->where('site_id', $siteId)->with(['tasks' => function($query){
            $query->orderBy('order');
        } ])->with('site')->orderBy('order')->get();
    }
    public function deleteStation(int $stationId, $user)
    {
        if($user->role === "Admin"){

            $stationToDelete = $this->stationModel->newQueryWithoutScope(ActiveScope::class)->where('id', $stationId);
        } else {
            $stationToDelete = $this->stationModel->where('admin_id', $user->id)->where('id', $stationId);
        }

        if(isset($stationToDelete->first()->tasks)) {

            foreach ($stationToDelete->first()->tasks as $task) {

                $task->track()->detach();
                $task->delete();

            }
        }

        return $stationToDelete->delete();
    }
}