<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public $fillable = [
        'name',
        'admin_id',
        'is_public'
    ];
    public function educands()
    {
        return $this->hasMany(Educand::class);
    }

    public function tasks()
    {
        return $this->BelongsToMany(Task::class)->withPivot(['order']);
    }


}
