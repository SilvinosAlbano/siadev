<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDepartamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_departamento';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'departamento';
}
