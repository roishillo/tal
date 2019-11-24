<?php

namespace App\Repositories\Admin;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class AdminRepository implements AdminInterface
{
    protected $adminModel;

    public function __construct(Model $admin)
    {
        $this->adminModel = $admin;
    }

    public function getById($adminId)
    {

        return $this->adminModel->with('sites')->where('id',$adminId)->first();

    }
    public function getByEmail($adminId)
    {

    }

    public function saveAdmin(array $adminData, int $adminId = null)
    {
        return $this->adminModel->newQueryWithoutScope(ActiveScope::class)->updateOrCreate(['id' => $adminId], $adminData);
    }
    public function resetPassword(array $passwordData, int $adminId)
    {
        return $this->adminModel->newQueryWithoutScope(ActiveScope::class)->where('id', $adminId)->update($passwordData);
    }
}