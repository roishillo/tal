<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducandTaskTrack extends Model
{
    public function datatable()
    {
        return $this->morphTo();
    }
}
