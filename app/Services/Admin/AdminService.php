<?php

namespace App\Services\Admin;

use App\Models\Entities\Admin;
use App\Models\Transformers\EducandTransformer;
use App\Models\Transformers\EducandTransformerForId;
use App\Repositories\Admin\AdminInterface;
use App\Repositories\Admin\AdminTransformer;
use App\Services\BaseService;
use Illuminate\Http\Request;

class AdminService extends BaseService
{
    protected $adminRepo;

    public function __construct(AdminInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function get($adminId)
    {
        return $this->adminRepo->getById($adminId);
    }

    public function getByEmail($adminEmail, Request $request)
    {
        try {
            $admin = Admin::where('email', $adminEmail)->first();
            $transformedAdmin = AdminTransformer::transform($admin);

            $educands = $admin->educands;
            $transformedEducands = array();
            foreach ($educands as $educand) {
                $transformedEducand = EducandTransformerForId::transform($educand, $request);
                array_push($transformedEducands, $transformedEducand);
            }

            return [$transformedAdmin, $transformedEducands];
        }
        catch (\Exception $exception)
        {
            return 'error';
        }
    }

    public function getLoggedInAdmin()
    {
        return auth()->guard('admins')->user();
    }

    public function validateAdminRequest(Request $request)
    {
        $userRole = auth()->guard('admins')->user()->role;
        if($userRole === 'Admin') {
            if ($request->role == 'Admin') {
                $validatedData = $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:admins,email,' . $request->id,
                    'password' => 'sometimes|required|min:6',
                    'role' => 'required',
                    'phone' => 'nullable|regex:/(0)[0-9]{9}/',
                    'second_phone' => 'nullable|regex:/(0)[0-9]{9}/',
                    'description' => 'nullable',
                ]);
            } elseif ($request->role == 'Site Builder' || 'Helper') {
                $validatedData = $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:admins,email,' . $request->id,
                    'password' => 'sometimes|required|min:6',
                    'role' => 'required',
                    'phone' => 'regex:/(0)[0-9]{9}/',
                    'second_phone' => 'nullable|regex:/(0)[0-9]{9}/',
                    'description' => 'nullable',
                ]);
            }
        } elseif ($userRole === 'Helper'){
                $validatedData = $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:admins,email,' . $request->id,
                    'password' => 'sometimes|required|min:6',
                    'role' => 'required|in:Helper',
                    'phone' => 'regex:/(0)[0-9]{9}/',
                    'second_phone' => 'nullable|regex:/(0)[0-9]{9}/',
                    'description' => 'nullable',
                ]);

        } else{
            $validatedData = null;
        }

        return $validatedData;
    }

    public function saveAdmin(array $data, int $adminId = null)
    {

        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $this->adminRepo->saveAdmin($data, $adminId);
    }

    public function validatePassword(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        return $validatedData;
    }
    public function resetPassword(array $data, int $adminId)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->adminRepo->resetPassword($data, $adminId);
    }

}