<?php

namespace App\Models\Transformers;

use App\Models\Entities\Educand;
use App\Models\Transformers\BaseTransformerAbstract;
use Illuminate\Http\Request;
use League\Fractal;

class EducandTransformerForId extends BaseTransformerAbstract
{
    public static function transform(Educand $educand, Request $request)
    {
        return [
            'id' => (int)$educand->id,
            'full_name1' => (string)$educand->full_name1,
            'full_name2' => (string)$educand->full_name2,
            'address' => (string)$educand->address,
            'about_me' => (string)$educand->about_me,
            'contact' => [
                'first_name' => (string)$educand->contact_first_name,
                'last_name' => (string)$educand->contact_last_name,
                'email' => (string)$educand->contact_last_email,
                'phone' => (string)$educand->contact_last_phone,
            ],
            'disability_level' => (string)$educand->disability_level,
            'visual_resource' => (string)$educand->visual_resource_path,
            'current_state' => (string)$educand->current_state,
            'birth_date' => (string)$educand->birth_date,
            'qr_instructions' => (string)$educand->qr_instructions_path,
            'educand_image_link' => (string) $request->root().'/uploads/original/'.$educand->visual_resource_path
        ];
    }
}