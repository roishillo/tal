<?php

namespace App\Models\Transformers;

use App\Models\Entities\Station;
use App\Models\Transformers\BaseTransformerAbstract;
use League\Fractal;

class StationTransformer extends BaseTransformerAbstract
{
    public static function transform(Station $station)
    {
        $visualPath = explode('/', $station->visual_resource_path);
        $visualPath = end($visualPath);

        return [
            'id' => (int)$station->id,
            'name' => (string)$station->name,
            'description' => (string)$station->description,
            'visual_resource' => (string)$visualPath,
            'site' => $station->site
        ];
    }
}