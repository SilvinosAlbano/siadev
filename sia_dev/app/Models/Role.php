<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_roles';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_roles',
        'name',
        'guard_name',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'module_permissions', 'role_id', 'permission_id')
                    ->withPivot('expires_at');
    }

    public function modelHasRoles()
    {
        return $this->hasMany(ModelHasRole::class, 'role_id', 'id_roles');
    }
}
