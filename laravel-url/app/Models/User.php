<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_ADMIN = 'admin';
    const ROLE_MEMBER = 'member';
    const ROLE_SALES = 'sales';
    const ROLE_MANAGER = 'manager';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * A user belongs to a company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Short URLs created by the user.
     */
    public function shortUrls()
    {
        return $this->hasMany(ShortUrl::class, 'created_by');
    }

    // -----------------------
    // Role Helpers
    // -----------------------

    public function isSuperAdmin() { return $this->role === self::ROLE_SUPERADMIN; }
    public function isAdmin() { return $this->role === self::ROLE_ADMIN; }
    public function isMember() { return $this->role === self::ROLE_MEMBER; }
    public function isSales() { return $this->role === self::ROLE_SALES; }
    public function isManager() { return $this->role === self::ROLE_MANAGER; }
}
