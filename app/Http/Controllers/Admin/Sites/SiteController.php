<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Http\Controllers\Controller;
use App\Models\Entities\Site;
use App\Services\Site\SiteFacade;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SiteController extends Controller
{
    public function createSite()
    {

        return view('admin.sites-management.create');
    }
    public function showSite($siteId)
    {
        $user = auth()->guard('admins')->user();
        $site = SiteFacade::get($siteId);
        $site->barcode = \DNS2D::getBarcodePNG('{"id":"'.$site->id.'", "ssid":"'.$site->wifi_name.'", "password":"'.$site->wifi_password.'"}', 'QRCODE');
        return view('admin.sites-management.create', compact('site', 'user'));
    }
    public function saveSite(Request $request, $siteId = null)
    {
        $user = auth()->guard('admins')->user();
        if ($siteId) {

            if ($user->id != Site::find($siteId)->admin_id) {
                toastr([
                    'type' => 'error',
                    'message' => 'wrong credentials'
                ]);

                return back();
            }
        }

        $validatedReq = SiteFacade::validateSiteRequest($request);

        $saved = SiteFacade::saveSite($validatedReq, $siteId);

        if ($saved) {

            return $saved->id;

        } else {
            toastr([
                'type' => 'error',
                'message' => 'site not saved'
            ]);
            return back();
        }
    }
    public function saveNewSite(Request $request)
    {

        $validatedReq = SiteFacade::validateSiteRequest($request);

        $saved = SiteFacade::saveNewSite($validatedReq);

        if ($saved) {

            return 'New Site created successfully';

        } else {
            toastr([
                'type' => 'error',
                'message' => 'site not saved'
            ]);
            return back();
        }
    }
    public function deleteSite($siteId)
    {
        $deleted = SiteFacade::deleteSite($siteId);

        if($deleted){

            return back();
        } else {
            toastr([
                'type' => 'error',
                'message' => 'site not deleted'
            ]);
        }
    }
    public function getTableQuery()
    {

        return DataTables::of(SiteFacade::getSites())

            ->editColumn('is_active', function(Site $site) {
                $user = auth()->guard('admins')->user();
                if($site->admin_id === $user->id || $user->role === 'Admin') {

                    if ($site->is_active) {
                        return '<a href="/admin/sites/' . $site->id . '/toggle-active" class=" toggle btn btn-sm btn-outline-primary"><i class="fa fa-toggle-on" style="padding-right: 5px";></i>Active</a>

                                    <a href="/admin/sites/' . $site->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>
                                    
                                     <button type="button" id="' . $site->id . '" name="' . $site->name . '" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_1"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>

                                    <a href="/admin/sites/' . $site->id . '/stations" class="btn btn-sm btn-outline-success"><i class="fa fa-sign" style="padding-right: 5px";></i>Stations</a>';
                    } else {
                        return '<a href="/admin/sites/' . $site->id . '/toggle-active" class=" toggle btn btn-sm btn-outline-primary"><i class=" fa fa-toggle-off" style="padding-right: 5px";></i>Inactive</a>

                                    <a href="/admin/sites/' . $site->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>
                                    
                                    <button type="button" id="' . $site->id . '" name="' . $site->name . '" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_1"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>

                                    <a href="/admin/sites/' . $site->id . '/stations" class="btn btn-sm btn-outline-success"><i class="fa fa-sign" style="padding-right: 5px";></i>Stations</a>';
                    }
                } else{
                    return '<a href="/admin/sites/' . $site->id . '" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Clone</a>';
                }

            })
            ->rawColumns(['is_active'])

            ->make(true);
    }

    public function toggleActive($siteId)
    {


        $admin = auth()->guard('admins')->user();
        $site = SiteFacade::get($siteId);
        if($admin->id == $site->admin_id || $admin->role === 'Admin'){
            $site->update(['is_active' => !$site->is_active]);

            return back();
        } else {

            toastr([
                'type' => 'error',
            'title' => 'Error',
            'message' => 'Unauthorized',
            ]);

            return back();
        }
    }
}
