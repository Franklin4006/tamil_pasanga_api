<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $appends = ['profile_path'];
    protected $fillable = [
        'name',
        'mobile',
        'username',
        'dob'
    ];

    protected $hidden = [
        'password',
    ];

    // JWT methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getProfilePathAttribute()
    {
        return $this->profile ? url('storage/' . $this->profile) : url('storage/users/icons.png');
    }
}
