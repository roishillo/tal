<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Entities\Task;
use App\Services\Site\SiteFacade;
use App\Services\Station\StationFacade;
use App\Services\Task\TaskFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index()
    {
        return view('admin.tasks-management.index');
    }
    public function getTasksTableQuery()
    {
        return DataTables::of(TaskFacade::getTasks())
            ->addColumn('management', function (Task $task){
                $user = auth()->guard('admins')->user();
                if($task->admin_id === $user->id || $user->role === 'Admin') {
                    return '<button type="button" id="' . $task->id . '" name="' . $task->name . '" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_1"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>
                            <a href="/admin/tasks/' . $task->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>';
                } else {
                    return '<a href="/admin/tasks/' . $task->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Clone</a>';
                }
            })
            ->rawColumns(['management'])
            ->make(true);
    }

    public function createTask($stationId = null)
    {

        if($stationId){
            $station = StationFacade::get($stationId);
        }
       $user = TaskFacade::getUserWithSitesAndStations();
        $sites = SiteFacade::getSites();
        $stations = StationFacade::getStations();
        return view('admin.tasks-management.create', compact('user', 'sites', 'stations', 'station'));
    }

    public function showTask($taskId)
    {
       $user = TaskFacade::getUserWithSitesAndStations();
       $task = TaskFacade::get($taskId);
        $sites = SiteFacade::getSites();
        $stations = StationFacade::getStations();
       return view('admin.tasks-management.create', compact('user', 'sites', 'stations', 'task'));
    }

    public function saveTask(Request $request, $taskId = null)
    {
        $validatedData = TaskFacade::validateTaskRequest($request);

        $saved = TaskFacade::saveTask($validatedData, $taskId);

        if($saved){
            return 'Task Saved Successfully';
        }
    }
    public function saveNewTask(Request $request)
    {
        $validatedData = TaskFacade::validateTaskRequest($request);

        $saved = TaskFacade::saveNewTask($validatedData);

        if($saved){
            return 'New Task Created Successfully';
        }
    }
    public function deleteTask($taskId)
    {
        $deleted = TaskFacade::deleteTask($taskId);

        if($deleted){

            return back();
        } else {
            toastr([
                'type' => 'error',
                'message' => 'task not deleted'
            ]);
        }
    }

    public function getStationTasks(Request $request)
    {
        return $tasks = TaskFacade::getStationTasks($request->id);
    }
}
