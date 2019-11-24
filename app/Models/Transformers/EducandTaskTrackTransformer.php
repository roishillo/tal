<?php

namespace App\Models\Transformers;

use App\Models\EducandTaskTrack;
use App\Models\Transformers\BaseTransformerAbstract;
use League\Fractal;

class EducandTaskTrackTransformer extends BaseTransformerAbstract
{
    public static function transform(EducandTaskTrack $educandTaskTrack)
    {
        return [
            'Start' => (integer)$educandTaskTrack->start_date,
            'End' => (integer)$educandTaskTrack->end_date,
            'Help_count' => (integer)$educandTaskTrack->help_count,
            'Type' => (string)$educandTaskTrack->item_type,
            'Id' => (integer)$educandTaskTrack->item_id
                ];
    }

}