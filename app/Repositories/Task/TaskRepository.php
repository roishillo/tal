<?php

namespace App\Repositories\Task;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class TaskRepository implements TaskInterface
{
    protected $taskModel;

    public function __construct(Model $task)
    {
        $this->taskModel = $task;
    }

    public function getById($taskId)
    {
        return $this->taskModel->find($taskId)->load('station.site');
    }
    public function getTasks($adminId)
    {
        $tasks = $this->taskModel->where('admin_id', $adminId)
            ->orWhere(function($query){
                $query->where('is_public', true)
                    ->where('is_active', true);
            })

            ->with('station.site')

            ->get();

        return $tasks;
    }
    public function saveTask(array $taskData, int $taskId = null)
    {
        return $this->taskModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $taskId], $taskData);
    }
    public function saveNewTask(array $taskData)
    {
        return $this->taskModel->newQueryWithoutScope(ActiveScope::class)->create($taskData);
    }
    public function deleteTask(int $taskId, $user)
    {

        if($user->role === 'Admin'){
            $taskToDelete = $this->taskModel->newQueryWithoutScope(ActiveScope::class)->where('id', $taskId);

        } else {
            $taskToDelete = $this->taskModel->newQueryWithoutScope(ActiveScope::class)->where('admin_id', $user->id)->where('id', $taskId);

        }


        $taskToDelete->first()->track()->detach();

        return $taskToDelete->delete();
    }
    public function getStationTasks($stationId)
    {

        return $this->taskModel->where('station_id', $stationId)->get();
    }
}