<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentModulesRoles extends Pivot
{
    protected $table = 'student_modules_roles'; // Name of the pivot table

    protected $fillable = ['expired_date']; // Fields you want to access on the pivot table
}
