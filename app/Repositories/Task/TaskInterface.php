<?php

namespace App\Repositories\Task;

interface TaskInterface
{
    public function getById($taskId);

    public function getTasks($adminId);

    public function saveTask(array $taskData, int $taskId = null);

}