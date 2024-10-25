<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelMateriaSemestre extends Model
{
    protected $table = 'materia_semestre';
    protected $primaryKey = 'id_materia_semestre';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_semestre',
        'id_materia',
        'id_departamento',
        'credito',
        'observacao',
        'estado'
    ];

    // Relacionamento com Semestre
    public function semestre()
    {
        return $this->belongsTo(ModelSemestre::class, 'id_semestre', 'id_semestre');
    }

    // Relacionamento com Materia
    public function materia()
    {
        return $this->belongsTo(ModelMateria::class, 'id_materia', 'id_materia');
    }
}
