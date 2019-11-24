<?php

namespace App\Http\Controllers\Admin\Tracks;

use App\Http\Controllers\Controller;
use App\Models\Entities\Track;
use App\Services\Educand\EducandFacade;
use App\Services\Site\SiteFacade;
use App\Services\Task\TaskFacade;
use App\Services\Track\TrackFacade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TrackController extends Controller
{
    public function index()
    {
        $educands = EducandFacade::getEducands();
        return view('admin.tracks-management.index', compact('educands'));
    }
    public function getTracksTableQuery()
    {
        return DataTables::of(TrackFacade::getTracks())
            ->addColumn('management', function (Track $track) {
                $user = auth()->guard('admins')->user();
                if($track->admin_id === $user->id || $user->role === 'Admin') {
                    return '
					     <button type="button" id =track-' . $track->id . ' class="btn btn-sm btn-outline-brand assign" data-toggle="modal" data-target="#m_modal_1" ><i class="fa fa-user-friends" style="padding-right: 5px";></i>Assign</button>
                        <button type="button" id="' . $track->id . '" name="' . $track->name . '" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_2"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>
                        <a href="/admin/tracks/' . $track->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>';
                } else {
                    return '<a href="/admin/tracks/' . $track->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Clone</a>';
                }

            })
            ->editColumn('created_at', function(Track $track){
                return with(new Carbon($track->created_at))->format('d/m/Y');
            })
            ->editColumn('updated_at', function(Track $track){
                return with(new Carbon($track->updated_at))->format('d/m/Y');
            })
            ->rawColumns(['management'])
            ->make(true);
    }

    public function setPublic(Request $request)
    {
        if(TrackFacade::setPublic($request)){
            return 'Public status successfully changed';
        };
    }

    public function createTrack()
    {
        $sites = SiteFacade::getSites();
        $tasks = TaskFacade::getTasks();
        return view('admin.tracks-management.create', compact('tasks', 'sites'));
    }
    public function showTrack($trackId)
    {
        $sites = SiteFacade::getSites();
        $track = TrackFacade::get($trackId);
        $tasks = TaskFacade::getTasks();
        $user = auth()->guard('admins')->user();
        return view('admin.tracks-management.edit', compact('track','tasks', 'user', 'sites'));
    }
    public function getTask(Request $request)
    {
        $task = TaskFacade::get($request->id);

        return $task;
    }
    public function saveTrack(Request $request, $trackId = null)
    {
        if($request->task_id && $request->order) {
            $validatedData = TrackFacade::validateTrackRequest($request);

            $saved = TrackFacade::saveTrack($validatedData, $trackId);

            if ($saved) {

                return 'Track Saved Successfully';
            } else {

                return response('Failed to save track', 421);
            }
        } else {
            return response('No Tasks Assigned', 421);
        }

    }
    public function saveNewTrack(Request $request)
    {
        $validatedData = TrackFacade::validateTrackRequest($request);

        $saved = TrackFacade::saveNewTrack($validatedData);

        if($saved){

            return 'Track Saved Successfully';
        }
    }

    public function deleteTrack($trackId)
    {
        $deleted = TrackFacade::deleteTrack($trackId);

        if($deleted != 'track is in use'){

            return back();
        } else {

            toastr([
                'type' => 'error',
                'message' => 'track is in use'
            ]);
            return back();
        }
    }

    public function assign(Request $request, $trackId)
    {
        $ids = EducandFacade::assign($request,$trackId);
        return $ids;
    }
}
