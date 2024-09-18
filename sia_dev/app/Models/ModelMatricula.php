<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelMatricula extends Model
{
    protected $table = 'matricula';
    protected $primaryKey = 'id_matricula';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_student',
        'id_programa_estudo',
        'id_semestre',
        'data_inicio',
        'data_fim',
        'status'
    ];

    // Relacionamento com Estudante
    public function student()
    {
        return $this->belongsTo(ModelStudent::class, 'id_student', 'id_student');
    }

    // Relacionamento com Semestre
    public function semestre()
    {
        return $this->belongsTo(ModelSemestre::class, 'id_semestre', 'id_semestre');
    }

    // Relacionamento com ProgramaEstudo
    public function programaEstudo()
    {
        return $this->belongsTo(ModelProgramaEstudo::class, 'id_programa_estudo', 'id_programa_estudo');
    }

    // Relacionamento com Materia através de Semestre e ProgramaEstudo
    public function materias()
    {
        return $this->hasManyThrough(
            ModelMateria::class,
            ModelMateriaSemestre::class,
            'id_semestre', // Chave estrangeira na tabela intermediária (materia_semestre)
            'id_materia', // Chave estrangeira na tabela de destino (materia)
            'id_semestre', // Chave local na tabela de origem (matricula)
            'id_materia'  // Chave local na tabela intermediária (materia_semestre)
        );
    }
}
