<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['user_id', 'username', 'email', 'password', 'docente_student_id', 'tipo_usuario'];
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
        return $this->belongsTo(Student::class, 'docente_student_id');
    }

    // Relationship with Docente
    public function docente(): BelongsTo
    {
        return $this->belongsTo(ModelDocente::class, 'docente_student_id');
    }

    // Relationship with Roles
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'student_modules_roles', 'user_id', 'role_id')
                    ->withPivot('module_id', 'expired_date')
                    ->withTimestamps();
    }

    // Relationship with Modules
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'student_modules_roles', 'user_id', 'module_id')
                    ->withPivot('role_id', 'expired_date')
                    ->withTimestamps();
    }
}
