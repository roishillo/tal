<?php

namespace App\Models\Entities;

use App\Models\EducandTaskTrack;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\ParentActiveScope;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public $parents = ['site'];

    public $fillable = [
        'name',
        'description',
        'is_public',
        'is_active',
        'site_id',
        'visual_resource_path',
        'order',
        'admin_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
        static::addGlobalScope(new ParentActiveScope());
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function educandTaskTrack()
    {
        return $this->morphMany(EducandTaskTrack::class, 'datatable');
    }
    public function tasks()
    {
        return $this->HasMany(Task::class);
    }
}
