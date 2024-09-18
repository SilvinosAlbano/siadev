<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelDocenteDaMateria extends Model
{
    protected $table = 'docente_materia';
    protected $primaryKey = 'id_docente_materia';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_funcionario',
        'id_materia',
        'data_inicio',
        'data_fim',
        'status'
    ];

    // Relacionamento com Materia
    public function materia()
    {
        return $this->belongsTo(ModelMateria::class, 'id_materia', 'id_materia');
    }

    // Relacionamento com Docente
    public function docente()
    {
        return $this->belongsTo(ModelDocente::class, 'id_funcionario', 'id_funcionario');
    }

    // Relacionamento com Horario
    public function horarios()
    {
        return $this->hasMany(ModelHorario::class, 'id_docente_da_materia', 'id_docente_da_materia');
    }
}
