<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSemestre extends Model
{
    use HasFactory;

    protected $table = 'semestre';
    protected $primaryKey = 'id_semestre';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_semestre',
        'numero_semestre',
        'ano_academico',
        'id_programa_estudo',
    ];

    // Relacionamento com Matricula
    public function matriculas()
    {
        return $this->hasMany(ModelMatricula::class, 'id_semestre', 'id_semestre');
    }

    // Relacionamento com ProgramaEstudo
    public function programaEstudo()
    {
        return $this->belongsTo(ModelProgramaEstudo::class, 'id_programa_estudo', 'id_programa_estudo');
    }

    // Relacionamento com MateriaSemestre
    public function materiasSemestre()
    {
        return $this->hasMany(ModelMateriaSemestre::class, 'id_semestre', 'id_semestre');
    }
}
