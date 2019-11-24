<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Educand extends Model
{
    protected $fillable = [
        'full_name1',
        'full_name2',
        'about_me',
        'address',
        'phone',
        'contact_first_name',
        'contact_last_name',
        'contact_last_email',
        'contact_last_phone',
        'gender',
        'visual_resource_path',
        'current_state',
        'birth_date',
        'qr_instructions_path',
        'admin_id'];

    public function track()
    {
        return $this->BelongsTo(Track::class);
    }
    public function admin()
    {
        return $this->BelongsTo(Admin::class);
    }
}
