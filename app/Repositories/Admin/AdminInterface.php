<?php

namespace App\Repositories\Admin;

interface AdminInterface
{
    public function getById($adminId);

    public function getByEmail($adminEmail);

}
