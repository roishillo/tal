<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\BaseController;

class DashboardController extends BaseController
{
    /**
     * Main method for showing view
     * @url GET /admin
     * @return View
     */
    public function index()
    {
        return view('admin.dashboard')->with('activeSidebar', 'dashboard');
    }
}
