<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\ApiErrorCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuthFacade;

class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = JWTAuthFacade::getToken();

            if (JWTAuthFacade::parseToken()->authenticate()) {
                return $next($request);
            }
        } catch (\Exception $ex) {

        }

        return $this->returnError($request);
    }

    private function returnError($request)
    {
            return response()->json([
                'data' => ApiErrorCodes::getError('LOGIN_ERRORS', 'INVALID_TOKEN'),
            ], 422);
    }
}