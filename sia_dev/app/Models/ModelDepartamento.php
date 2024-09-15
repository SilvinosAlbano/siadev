<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDepartamento extends Model
{
    protected $table = 'departamento';
    protected $primaryKey = 'id_departamento';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['nome_departamento', 'id_faculdade'];

    // Relationships
    public function faculdade()
    {
        return $this->belongsTo(ModelFaculdade::class, 'id_faculdade', 'id_faculdade');
    }

    public function programasEstudo()
    {
        return $this->hasMany(ModelProgramaEstudo::class, 'id_departamento', 'id_departamento');
    }
}
