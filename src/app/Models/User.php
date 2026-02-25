<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'reputation',
        'is_banned',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'role' => 'string',
        'status' => 'string',
        'is_banned' => 'boolean',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(ColocationMember::class);
    }
}
