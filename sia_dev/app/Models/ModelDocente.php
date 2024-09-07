<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class ModelDocente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_docente';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'docentes';

    protected $fillable = [
        'id_docente',
        'nome_docente',
        'sexo',
        'suco',
        'id_posto_administrativo',
        'id_municipio',
        'data_moris',
        'nacionalidade',
        'nivel_educacao',
        'area_especialidade',
        'universidade_origem',
        'ano_inicio',
        'id_estatuto',
        'id_departamento',
        'observacao',
        'photo_docente'
    ];

    
}