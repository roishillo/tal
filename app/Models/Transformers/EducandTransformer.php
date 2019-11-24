<?php

namespace App\Models\Transformers;

use App\Models\Entities\Educand;
use App\Models\Transformers\BaseTransformerAbstract;
use League\Fractal;

class EducandTransformer extends BaseTransformerAbstract
{
    public static function transform(Educand $educand)
    {
        return [
            'id' => (int)$educand->id,
            'full_name1' => (string)$educand->full_name1,
            'full_name2' => (string)$educand->full_name2,
            'address' => (string)$educand->address,
            'visual_resource' => (string)$educand->visual_resource_path,
        ];
    }
}