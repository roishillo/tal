<?php

namespace App\Repositories\Track;

use App\Models\EducandTaskTrack;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TrackRepository implements TrackInterface
{
    protected $trackModel;
    protected $taskTrackModel;

    public function __construct(Model $track, EducandTaskTrack $taskTrackModel)
    {
        $this->trackModel = $track;
        $this->taskTrackModel = $taskTrackModel;
    }

    public function getById($trackId)
    {
        return $this->trackModel->find($trackId)->load('tasks');
    }
    public function getTracks($adminId)
    {
        $tracks = $this->trackModel->where('admin_id', $adminId)
            ->orWhere(function($query){
                $query->where('is_public', true);
            })
            ->get();
        return $tracks;
    }
    public function setPublic(Request $request, int $adminId)
    {
        $item = ($this->trackModel->where('admin_id',$adminId)->where('id', $request->id)->first());
        $item->is_public = !$item->is_public;
        return $item->save();

    }
    public function saveTrack(array $trackData, int $trackId = null)
    {
        $track =  $this->trackModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $trackId], $trackData);
        foreach ($trackData['task_id'] as $index=>$task ){
            if(!$track->tasks->contains($task)) {
                if(isset($trackData['order'][$index])) {
                    $track->tasks()->attach([$task], ['order' => $trackData['order'][$index]]);
                }
            }
        }
        foreach ($track->tasks as $task){
            if(!in_array($task->id, $trackData['task_id'])){
                if(isset($trackData['order'][$index])) {
                    $track->tasks()->detach([$task->id], ['order' => $trackData['order'][$index]]);
                }
            }
        }
        return $track;
    }
    public function saveNewTrack(array $trackData)
    {
        $track =  $this->trackModel->newQueryWithoutScope(ActiveScope::class)->Create($trackData);
        foreach ($trackData['task_id'] as $index=>$task ){
            if(!$track->tasks->contains($task)) {
                if(isset($trackData['order'][$index])) {
                    $track->tasks()->attach([$task], ['order' => $trackData['order'][$index]]);
                }
            }
        }
        foreach ($track->tasks as $task){
            if(!in_array($task->id, $trackData['task_id'])){
                if(isset($trackData['order'][$index])) {
                    $track->tasks()->detach([$task->id], ['order' => $trackData['order'][$index]]);
                }
            }
        }
    }
    public function deleteTrack(int $trackId, $user)
    {


        if($user->role === "Admin"){

            $trackToDelete = $this->trackModel->where('id', $trackId);
        } else {
            $trackToDelete = $this->trackModel->where('admin_id', $user->id)->where('id', $trackId);
        }

        if(isset($trackToDelete->first()->educands)) {

            if($this->taskTrackModel->where('track_id',$trackId)->whereNotNull('start_date')->whereNull('end_date')->first()){

                return 'track is in use';
            }
            foreach ($trackToDelete->first()->educands as $educand) {
                $this->taskTrackModel->where('track_id', $trackId)->where('educand_id', $educand->id)->delete();
                $educand->track_id = null;
                $educand->save();
            }
            $trackToDelete->first()->tasks()->detach();
        }
        return $trackToDelete->delete();
    }

}