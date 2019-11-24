<?php

namespace App\Services\Task;

use App\Repositories\Task\TaskInterface;
use App\Services\Admin\AdminFacade;
use Illuminate\Http\Request;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function get($taskId)
    {
        return $this->taskRepo->getById($taskId);
    }
    public function getTasks()
    {
        $adminId = AdminFacade::getLoggedInAdmin()->id;
        return $this->taskRepo->getTasks($adminId);
    }

    public function getUserWithSitesAndStations()
    {
        $user = AdminFacade::getLoggedInAdmin();
        return $user->load('sites.stations', 'stations');

    }

    public function validateTaskRequest(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'station_id' => 'required',
            'is_active' => 'in:"on"|nullable',
            'is_public' => 'in:"on"|nullable',
            'visual_resource_path' => 'required',
            'audio_resource_path' => 'required',
        ]);

        return $validatedData;
    }

    public function saveTask(array $data, int $taskId = null)
    {
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['order'] = 100;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        $data['is_active'] = array_get($data, 'is_active') == 'on';
        return $this->taskRepo->saveTask($data, $taskId);
    }
    public function saveNewTask(array $data)
    {
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        $data['is_active'] = array_get($data, 'is_active') == 'on';
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['order'] = 100;
        return $this->taskRepo->saveNewTask($data);
    }
    public function deleteTask(int $taskId)
    {
        $user = auth()->guard('admins')->user();
        return $this->taskRepo->deleteTask($taskId, $user);
    }
    public function getStationTasks(string $stationId = null)
    {
        return $this->taskRepo->getStationTasks($stationId);
    }
}