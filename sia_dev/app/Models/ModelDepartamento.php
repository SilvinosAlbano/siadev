<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDepartamento extends Model
{
    protected $table = 'departamento'; // Make sure this matches your table name
    protected $primaryKey = 'id_departamento'; // Adjust if necessary
    public $incrementing = false; // If using UUIDs
    protected $keyType = 'string'; // If using UUIDs
    protected $fillable = ['id_departamento', 'departamento', 'faculdade'];
}
