<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_permissions';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_permissions',
        'name',
        'guard_name',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'module_permissions', 'permission_id', 'role_id')
                    ->withPivot('expires_at');
    }

    public function modelHasPermissions()
    {
        return $this->hasMany(ModelHasPermission::class, 'permission_id', 'id_permissions');
    }
}
