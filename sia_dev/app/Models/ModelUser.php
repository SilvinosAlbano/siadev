<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

    public function roles()
    {
        return $this->belongsToMany(ModelRole::class, 'student_modules_roles', 'user_id', 'role_id');
    }

    public function modules()
    {
        return $this->belongsToMany(ModelModule::class, 'student_modules_roles', 'user_id', 'module_id');
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
        /* // Check if user has roles
        $roles = $this->roles()->pluck('role_name');  // Pluck the role names for debugging
        Log::info("User roles: " . implode(', ', $roles->toArray()));

        // Check for access in the pivot table
        $hasAccess = $this->roles()
            ->wherePivot('role_id', function ($query) use ($permission) {
                $query->select('id_roles')
                    ->from('roles')
                    ->where('role_name', $permission);  // Matches 'Read'
            })
            ->whereHas('modules', function ($query) use ($module) {
                $query->where('module_key', $module);  // Matches 'students'
            })
            ->exists();

        Log::info("User ID: {$this->user_id}, Permission: {$permission}, Module: {$module}, Access: {$hasAccess}");

        return $hasAccess; */
        DB::enableQueryLog();

        $hasAccess = $this->roles()
            ->wherePivot('role_id', function ($query) use ($permission) {
                $query->select('id_roles')
                    ->from('roles')
                    ->where('role_name', $permission);
            })
            ->whereHas('modules', function ($query) use ($module) {
                $query->where('module_key', $module);
            })
            ->exists();

        Log::debug(DB::getQueryLog()); // Log the generated SQL query
        Log::info("User ID: {$this->user_id}, Permission: {$permission}, Module: {$module}, Access: {$hasAccess}");

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
