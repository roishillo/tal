<?php

namespace App\Repositories\Site;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class SiteRepository implements SiteInterface
{
    protected $siteModel;

    public function __construct(Model $site)
    {
        $this->siteModel = $site;
    }

    public function getById($siteId)
    {
        return $this->siteModel->withoutGlobalScope(ActiveScope::class)->where('id',$siteId)->first();
    }
    public function getSites($admin)
    {
        if($admin->role === "Admin") {
            $sites = $this->siteModel
                ->get();
        } else {
            $sites = $this->siteModel->where('admin_id', $admin->id)
                ->orWhere(function ($query) {
                    $query->where('is_public', true)
                        ->where('is_active', true);
                })
                ->withoutGlobalScopes()
                ->get();
        }
        return $sites->load('stations');
    }

    public function saveSite(array $siteData, int $siteId = null)
    {
            return $this->siteModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $siteId], $siteData);
    }
    public function saveNewSite(array $siteData)
    {
        return $this->siteModel->newQueryWithoutScope(ActiveScope::class)->create($siteData);
    }
    public function deleteSite(int $siteId, $user)
    {

        if($user->role === 'Admin'){
            $siteToDelete = $this->siteModel->where('id', $siteId);

        } else {
            $siteToDelete = $this->siteModel->where('admin_id', $user->id)->where('id', $siteId);

        }

        if(isset($siteToDelete->first()->stations)) {

            foreach ($siteToDelete->first()->stations as $station) {
                foreach ($station->first()->tasks as $task) {

                    $task->track()->detach();
                    $task->delete();

                }
                $station->delete();

            }
//            $siteToDelete->first()->tasks()->detach();
        }
        return $siteToDelete->delete();
    }
    public function toggle($site)
    {
        return $site->update(['is_active' => !$site->is_active]);
    }
    public function getPredictedNumberOfStations($siteId)
    {
        return $this->siteModel->newQueryWithoutScopes([ActiveScope::class])->where('id', $siteId)->pluck('predicted_stations')->first();
    }
}