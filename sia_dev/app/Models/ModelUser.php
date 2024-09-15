<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class ModelUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['user_id', 'username', 'email', 'password', 'docente_id_student', 'tipo_usuario'];
    protected $hidden = ['password', 'remember_token'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_id = (string) Str::uuid();
        });
    }

    // Relationship with Student
    public function student(): BelongsTo
    {
        return $this->belongsTo(ModelStudent::class, 'docente_id_student');
    }

    // Relationship with Docente
    public function docente(): BelongsTo
    {
        return $this->belongsTo(ModelDocente::class, 'docente_id_student');
    }

    // Role relationship in User model
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(ModelRole::class, 'student_modules_roles', 'user_id', 'role_id')
            ->withPivot('module_id', 'expired_date')
            ->withTimestamps();
    }

    // Module relationship in User model
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(ModelModule::class, 'student_modules_roles', 'user_id', 'module_id')
            ->withPivot('role_id', 'expired_date')
            ->withTimestamps();
    }


    public function hasRole($role)
    {
        return $this->roles()->where('role_name', $role)->exists();
    }

    public function hasModuleAccess($module)
    {
        return $this->modules()->where('module_key', $module)->exists();
    }
    public function canAccess($permission, $module)
    {
        $hasAccess = $this->roles()
            ->wherePivot('role_id', function ($query) use ($permission) {
                $query->select('id_roles')
                    ->from('roles')
                    ->where('role_name', $permission);
            })
            ->whereHas('modules', function ($query) use ($module) {
                $query->where('module_key', $module);
            })->exists();

        //Log::info("User ID: {$this->user_id}, Permission: {$permission}, Module: {$module}, Access: {$hasAccess}");

        return $hasAccess;
    }

    public function hasAnyAccess(array $permissions, $module)
    {
        foreach ($permissions as $permission) {
            if ($this->canAccess($permission, $module)) {
                return true;
            }
        }
        return false;
    }
}
