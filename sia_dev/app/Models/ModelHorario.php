<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHorario extends Model
{
    use HasFactory;

    protected $table = 'horario_de_ensino';
    protected $primaryKey = 'id_horario_de_ensino';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_horario_de_ensino',
        'id_docente_da_materia',
        'id_horas',
        'id_sala',
        'id_data',
    ];

    // Relacionamento com DocenteDaMateria
    public function docenteMateria()
    {
        return $this->belongsTo(ModelDocenteDaMateria::class, 'id_docente_da_materia', 'id_docente_da_materia');
    }

    // Relacionamento com Sala
    // public function sala()
    // {
    //     return $this->belongsTo(ModelSala::class, 'id_sala', 'id_sala');
    // }

    // Relacionamento com Horas
    // public function horas()
    // {
    //     return $this->belongsTo(ModelHoras::class, 'id_horas', 'id_horas');
    // }

    // Relacionamento com Datas
    // public function data()
    // {
    //     return $this->belongsTo(ModelData::class, 'id_data', 'id_data');
    // }
}
