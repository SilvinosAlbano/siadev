<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ModuleUser extends Pivot
{
    protected $table = 'module_user'; // Name of the pivot table

    protected $fillable = ['expires_at']; // Fields you want to access on the pivot table
}
