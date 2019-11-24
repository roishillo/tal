<?php

namespace App\Services\Track;

use App\Repositories\Track\TrackInterface;
use App\Services\Admin\AdminFacade;
use Illuminate\Http\Request;

class TrackService
{
    protected $trackRepo;

    public function __construct(TrackInterface $trackRepo)
    {
        $this->trackRepo = $trackRepo;
    }

    public function get($trackId)
    {
        return $this->trackRepo->getById($trackId);
    }
    public function getTracks()
    {
        $adminId = AdminFacade::getLoggedInAdmin()->id;
        return $this->trackRepo->getTracks($adminId);
    }

    public function setPublic($request)
    {
        $adminId = AdminFacade::getLoggedInAdmin()->id;
        return $this->trackRepo->setPublic($request, $adminId);
    }
    public function validateTrackRequest(Request $request)
    {

       $taskSize = sizeof($request->task_id);
        $orderSize = sizeof($request->order);
        $validatedData = $request->validate([
            'name' => 'required',
            'task_id' => 'required|size:'.$orderSize.'',
            'order' => 'required|size:'.$taskSize.'',
            'is_public' => 'in:"on"|nullable',
        ]);
        return $validatedData;
    }
    public function saveTrack(array $data, int $trackId = null)
    {

        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        return $this->trackRepo->saveTrack($data, $trackId);
    }
    public function saveNewTrack(array $data)
    {

        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        return $this->trackRepo->saveNewTrack($data);
    }
    public function deleteTrack(int $trackId)
    {
        $user = auth()->guard('admins')->user();
        return $this->trackRepo->deleteTrack($trackId, $user);
    }
}