<?php

namespace App\Models\Entities;

use App\Models\EducandTaskTrack;
use App\Models\Scopes\ParentActiveScope;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $parents = ['station'];

    public $fillable = [
        'station_id',
        'name',
        'description',
        'visual_resource_path',
        'audio_resource_path',
        'order',
        'is_public',
        'admin_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ParentActiveScope());
    }
    public function track()
    {
        return $this->BelongsToMany(Track::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
    public function educandTaskTrack()
    {
        return $this->morphMany(EducandTaskTrack::class, 'datatable');
    }
}
