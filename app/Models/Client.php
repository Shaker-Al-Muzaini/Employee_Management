<?php

namespace App\Models;

use Laravel\Paddle\Billable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static first()
 */
class Client extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable , Billable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        "phone"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
