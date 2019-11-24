<?php

namespace App\Traits;

use App\Support\ApiErrorCodes;
use App\Http\Controllers\Controller;

trait ApiResponseTrait
{
    public function error($category, $errorType)
    {
        return response()->json([
            'data' => ApiErrorCodes::getError($category, $errorType),
        ], 422);
    }

    public function success($data)
    {
        return response()->json([
            'data' => $data,
        ], 200);
    }
}