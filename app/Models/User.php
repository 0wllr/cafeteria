<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    //Jerarquía de roles
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_VENDEDOR = 'ROLE_VENDEDOR';
    const ROLE_CLIENT = 'ROLE_CLIENT';

    private const ROLES_HIERARCHY = [
        self::ROLE_ADMIN => [self::ROLE_VENDEDOR],
        self::ROLE_VENDEDOR => [self::ROLE_CLIENT],
        self::ROLE_CLIENT => []
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
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    //Verificar rol
    public function isGranted($role)
    {
        if ($role === $this->role) {
            return true;
        }
            return self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$this->role]);
    }
    //Verificar que el rol esté en la jerarquía
    private static function isRoleInHierarchy($role, $role_hierarchy)
    {
        if (in_array($role, $role_hierarchy)) {
            return true;
        }
        foreach ($role_hierarchy as $role_included) {
            if(self::isRoleInHierarchy($role,self::ROLES_HIERARCHY[$role_included])){
                return true;
            }
        }
                return false;
    }

}
