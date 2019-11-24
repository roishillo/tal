<?php

namespace App\Models\Transformers;

use App\Models\Entities\Track;
use App\Models\Transformers\BaseTransformerAbstract;
use League\Fractal;

class TrackTransformer extends BaseTransformerAbstract
{
    public static function transform(Track $track)
    {
        return [
            'id' => (int)$track->id,
            'name' => (string)$track->name,
            'tasks' => $track->tasks
//                . $this->date(start_date);
        ];
    }
}