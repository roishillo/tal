<?php

namespace App\Repositories\Educand;

use App\Models\Entities\Educand;

interface EducandInterface
{
    public function getById($educandId);

    public function findTrackById($track);

    public function getEducandWithdata(Educand $educand);

}