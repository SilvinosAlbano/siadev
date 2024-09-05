<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id_roles';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['role_name', 'description'];

    // Relationship with users through student_modules_roles
    public function users()
    {
        return $this->belongsToMany(User::class, 'student_modules_roles', 'role_id', 'user_id')
                    ->withPivot('expired_date');
    }

    // Relationship with modules if needed
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'student_modules_roles', 'role_id', 'module_id')
                    ->withPivot('expired_date');
    }
}
