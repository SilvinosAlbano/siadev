<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['user_id', 'name', 'email', 'password', 'docente_student_id','tipo_usuario'];
    protected $hidden = ['password', 'remember_token'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_id = (string) Str::uuid();
        });
    }

    // Relationship with roles through student_modules_roles
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'student_modules_roles', 'user_id', 'module_id')
                    ->withPivot('role_id', 'expired_date')
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'student_modules_roles', 'user_id', 'role_id')
                    ->withPivot('expired_date')
                    ->withTimestamps();
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'docente_student_id');
    }

    public function docente()
    {
        return $this->belongsTo(ModelDocente::class, 'docente_student_id');
    }

}
