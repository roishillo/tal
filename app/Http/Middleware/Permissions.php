<?php

namespace App\Http\Middleware;

use App\Models\Entities\Admin;
use App\Services\Admin\AdminFacade;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\JWT;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$allowedRoles)
    {

        $user = AdminFacade::getLoggedInAdmin();
        if(in_array($user->role, $allowedRoles)){
            return $next($request);
        } else {
            return redirect('/');
        }
    }


}
