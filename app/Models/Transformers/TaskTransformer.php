<?php

namespace App\Models\Transformers;

use App\Models\Entities\Task;
use App\Models\Transformers\BaseTransformerAbstract;
use League\Fractal;

class TaskTransformer extends BaseTransformerAbstract
{
    public static function transform(Task $task)
    {
        $visualPath = explode('/', $task->visual_resource_path);
        $visualPath = end($visualPath);

        $audioPath = explode('/', $task->audio_resource_path);
        $audioPath = end($audioPath);

        $helpAudioPath = explode('/', $task->helper_audio_resource_path);
        $helpAudioPath = end($helpAudioPath);
        return [
            'id' => (int)$task->id,
            'name' => (string)$task->name,
            'description' => (string)$task->description,
            'visual_resource' => (string)$visualPath,
            'audio_resource' => (string)$audioPath,
            'Help_audio_resource' => (string)$helpAudioPath,
            'Help_description' => (string)$task->helper_description,
            'station' => $task->station
        ];
    }
}