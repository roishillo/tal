<?php

namespace App\Repositories\Educand;

use App\Models\EducandTaskTrack;
use App\Models\Entities\Educand;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EducandRepository implements EducandInterface
{
    protected $educandModel;

    public function __construct(Model $educand)
    {
        $this->educandModel = $educand;
    }

    public function getById($educandId)
    {

        return $this->educandModel->find($educandId);
    }
    public function get($user, $educandId)
    {
        if($user->role === "Admin"){
            return $this->educandModel->find($educandId);
        } else {
            return $this->educandModel->where('admin_id', $user->id)->find($educandId);
        }

    }
    public function getAll($user)
    {
        if($user->role === "Admin"){
            return $this->educandModel->all();
        } else {
            return $this->educandModel->where('admin_id', $user->id)->get();
        }
    }

    public function findTrackById($track)
    {
        return EducandTaskTrack::where('track_id', $track['id'])->first();

    }

    public function saveNewEducand($data)
    {
        return $this->educandModel->newQueryWithoutScope(ActiveScope::class)->create($data);
    }

    public function getEducandWithdata(Educand $educand)
    {

            return $educand->load('track.tasks.station.site');


    }

    public function getEducands($admin)
    {
        if($admin->role === 'Admin') {
            $educands = $this->educandModel->get();

        } else {
            $educands = $this->educandModel->where('admin_id', $admin->id)->get();
        }
        return $educands;
    }
    public function save(array $educandData, int $educandId = null)
    {
        return $this->educandModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $educandId], $educandData);
    }
    public function delete(int $educandId, $user)
    {
        if($user->role === 'Admin'){
            $educandToDelete = $this->educandModel->newQueryWithoutScope(ActiveScope::class)->where('id', $educandId);
        } else {
            $educandToDelete = $this->educandModel->newQueryWithoutScope(ActiveScope::class)->where('admin_id', $user->id)->where('id', $educandId);
        }

        return $educandToDelete->delete();
    }
    public function assign(Request $request, int $trackId, $user)
    {

        if($user->role === "Admin"){
            $educands = $this->educandModel->find($request->educands);

        } else {
            $educands = $this->educandModel->where('admin_id', $user->id)->find($request->educands);
        }
       if($educands) {
           $ids =$educands->pluck('id');

           $this->educandModel->whereIn('id', $ids)->update(['track_id' => $trackId]);
           $this->educandModel->whereNotIn('id', $ids)->where('track_id', $trackId)->update(['track_id' => null]);
           return $ids;
       } else {
           $this->educandModel->where('track_id', $trackId)->update(['track_id' => null]);
       }

        return null;

    }
}