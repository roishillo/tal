<?php

namespace App\Support;

use App\Traits\ApiResponseTrait;
use App\Support\ApiErrorCodes;
use App\Http\Controllers\Controller;

class ApiErrorHandler
{
    use ApiResponseTrait;
}