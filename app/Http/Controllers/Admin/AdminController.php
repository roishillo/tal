<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entities\Admin;
use App\Models\Entities\Educand;
use App\Models\Entities\Site;
use App\Models\Scopes\ActiveScope;
use App\Services\Admin\AdminFacade;
use App\Services\Educand\EducandFacade;
use App\Services\Site\SiteFacade;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->guard('admins')->user();
        return view('admin.admins-management.index', compact('user'));
    }
    public function select()
    {
        $user = auth()->guard('admins')->user();
        return view('admin.admins-management.new', compact('user'));
    }
    public function show($adminId)
    {
      $admin = AdminFacade::get($adminId);
        $user = auth()->guard('admins')->user();
      return view('admin.admins-management.edit', compact('admin', 'user'));

    }
    public function reset($adminId)
    {
        $admin = AdminFacade::get($adminId);

        return view('admin.admins-management.resetPassword', compact('admin'));

    }
    public function save(Request $request, $adminId = null)
    {

        if($request->role == 'Admin' || $request->role == 'Site Builder' || $request->role == 'Helper') {

            $validatedData = AdminFacade::validateAdminRequest($request);

            $saved = AdminFacade::saveAdmin($validatedData, $adminId);

        } elseif($request->role == 'Educand') {

            $validatedData = EducandFacade::validateEducandRequest($request);

            $saved = EducandFacade::saveNewEducand($validatedData);
        }
        if ($saved) {

            return 'User Saved Successfully';
        } else {
            toastr([
                'type' => 'error',
                'message' => 'admin not saved'
            ]);
            return back();
        }
    }public function resetPassword(Request $request, $adminId)
{

    $validatedData = AdminFacade::validatePassword($request);

    $reset =  AdminFacade::resetPassword($validatedData, $adminId);

    if ($reset) {

        return 'Password Reset Successfully';
    } else {
        toastr([
            'type' => 'error',
            'message' => 'Password Not saved'
        ]);
        return back();
    }
}

    public function educands()
    {
        return view('admin.educands-management.index');
    }
    public function sites()
    {
        return view('admin.sites-management.index');
    }


    public function getTableQuery()
    {
        $user = auth()->guard('admins')->user();
        if($user->role === 'Admin') {
            return DataTables::of(Admin::query())
                ->addColumn('management', function (Admin $admin) {
                    $loggedInAdmin = AdminFacade::getLoggedInAdmin();
                    if ($loggedInAdmin->role == 'Admin') {
                        return '<a href="/admin/admins/' . $admin->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>
                        <a href="/admin/admins/' . $admin->id . '/reset" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Reset Password</a>';
                    } else {
                        return '<a href="/admin/admins/' . $admin->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>';
                    }

                })
                ->rawColumns(['management'])
                ->make(true);
        } else {
            return DataTables::of(Admin::where('id',$user->id))
                ->addColumn('management', function (Admin $admin) {
                    $loggedInAdmin = AdminFacade::getLoggedInAdmin();
                    if ($loggedInAdmin->role == 'Admin') {
                        return '<a href="/admin/admins/' . $admin->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>
                        <a href="/admin/admins/' . $admin->id . '/reset" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Reset Password</a>';
                    } else {
                        return '<a href="/admin/admins/' . $admin->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>';
                    }

                })
                ->rawColumns(['management'])
                ->make(true);
        }
    }
    public function passwordReset($token)
    {
        return view('auth.passwords.reset', compact('token'));
    }

    public function getEducandsTableQuery()
    {
        return DataTables::of(Educand::query())
            ->make(true);
    }





}
