<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Factory;

class AuthenticateAdmin
{
	/**
	 * The authentication factory instance.
	 *
	 * @var Factory
	 */
	protected $auth;

	/**
	 * Create a new middleware instance.
	 *
	 * @param Factory|Auth $auth
	 */
	public function __construct(Auth $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string $guard
	 * @return mixed
	 *
	 */
	public function handle($request, Closure $next, $guard = 'admins')
	{
		if (Auth::guard($guard)->guest()) {
			if ($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect(url('admin/login'));
			}
		}

		return $next($request);
	}

}