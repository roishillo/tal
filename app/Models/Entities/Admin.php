<?php

namespace App\Models\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User implements JWTSubject
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = ['email', 'first_name', 'last_name', 'password', 'role', 'phone', 'second_phone', 'organization'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function educands() {
        return $this->hasMany(Educand::class);
    }
    public function sites() {
        return $this->hasMany(Site::class)->orWhere('sites.is_public', true);
    }
    public function stations() {
        return $this->hasMany(Station::class);
    }
}
