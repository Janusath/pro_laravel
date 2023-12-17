<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EntrepreneurUser extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'userName',
        'location',
        'phoneNo',
        'email',
        'other',
        'password',
    ];

       /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
         'password' => 'hashed',
    ];
}
