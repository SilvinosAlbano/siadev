<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['user_id', 'name', 'email', 'password', 'student_id'];
    protected $hidden = ['password', 'remember_token'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_id = (string) Str::uuid();
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
                    ->where('model_type', self::class);
    }

    public function modules()
    {
        return $this->belongsToMany(ModulePermission::class, 'model_has_permissions', 'model_id', 'permission_id')
                    ->where('model_type', self::class);
    }
}
