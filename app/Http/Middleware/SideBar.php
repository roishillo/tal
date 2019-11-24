<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class SideBar
{
	/**
	 * Handle an incoming request.
	 * This middleware is sharing the sidebar after permissions check
	 * for sidebar items
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 *
	 */
	public function handle($request, Closure $next)
	{
		// Sharing the sidebar items to view
		$sideBarItems = config('side-bar');

        $currentActivePage = array_filter($sideBarItems, function ($item) {
            return $item['route'] == \Route::currentRouteName();
        });

        $currentActivePage = count($currentActivePage) ? array_values($currentActivePage)[0] : null;

		View::share('sideBarItems', $sideBarItems);
		View::share('currentActivePage', $currentActivePage);

		return $next($request);
	}
}