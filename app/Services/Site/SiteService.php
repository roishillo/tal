<?php

namespace App\Services\Site;

use App\Repositories\Site\SiteInterface;
use App\Services\Admin\AdminFacade;
use Illuminate\Http\Request;

class SiteService
{
    protected $siteRepo;

    public function __construct(SiteInterface $siteRepo)
    {
        $this->siteRepo = $siteRepo;
    }

    public function get($siteId)
    {

        return $this->siteRepo->getById($siteId);

    }
    public function getSites()
    {
        $admin = AdminFacade::getLoggedInAdmin();
        return $this->siteRepo->getSites($admin);
    }
    public function saveSite(array $data, int $siteId = null)
    {
        $data['helper_phone_audio_path'] = 'v2HiG82ZV8GHPz3lCv9TaclL45z4sioK5VVRLz5z.mpga';
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        $data['is_active'] = array_get($data, 'is_active') == 'on';

        return $this->siteRepo->saveSite($data, $siteId);
    }
    public function saveNewSite(array $data)
    {
        $data['helper_phone_audio_path'] = 'v2HiG82ZV8GHPz3lCv9TaclL45z4sioK5VVRLz5z.mpga';
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        $data['is_public'] = array_get($data, 'is_public') == 'on';
        $data['is_active'] = array_get($data, 'is_active') == 'on';

        return $this->siteRepo->saveNewSite($data);
    }
    public function deleteSite(int $siteId)
    {
        $user = auth()->guard('admins')->user();
        return $this->siteRepo->deleteSite($siteId, $user);
    }
    public function validateSiteRequest(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'wifi_name' => 'required',
            'wifi_password' => 'required',
            'address' => 'required',
            'description' => 'required',
            'helper_name' => 'required',
            'helper_phone' => 'required|regex:/(0)[0-9]{9}/',
            'helper_phone_whatsapp' => 'required',
            'visual_resource_path' => 'required|regex:/(.+).jpeg/i',
            'audio_resource_path' => 'required|regex:/(.+).mpga/i',
            'predicted_stations' => 'required|numeric|min:1|max:99',
            'web_link' => 'required',
            'is_active' => 'in:"on"|nullable',
            'is_public' => 'in:"on"|nullable',
        ]);

        return $validatedData;
    }

    public function toggle($siteId)
    {
        $admin = auth()->guard('admins')->user();
        $site = SiteFacade::get($siteId);

        if($admin->id == $site->admin_id || $admin->role === 'Admin'){
            return $this->siteRepo->toggle($site);
        }
    }
    public function getPredictedNumberOfStations($siteId)
    {
        return $this->siteRepo->getPredictedNumberOfStations($siteId);
    }
}