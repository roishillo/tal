<?php

namespace App\Models\Entities;

use App\Models\EducandTaskTrack;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $fillable = [
        'name',
        'description',
        'address',
        'web_link',
        'helper_name',
        'helper_phone',
        'helper_phone_whatsapp',
        'helper_phone_audio_path',
        'wifi_name',
        'wifi_password',
        'predicted_stations',
        'is_public',
        'is_active',
        'visual_resource_path',
        'audio_resource_path',
        'admin_id',
    ];

    protected static function boot()
    {
        parent::boot();

    }

    public function educandTaskTrack()
    {
        return $this->morphMany(EducandTaskTrack::class, 'datatable');
    }

    public function stations()
    {
        return $this->hasMany(Station::class);
    }

}
