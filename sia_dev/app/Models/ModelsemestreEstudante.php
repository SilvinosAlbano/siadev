<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsemestreEstudante extends Model
{
    use HasFactory;

    protected $table = 'semestre_estudante';
    protected $primaryKey = 'id_semestre_estudante';
    public $incrementing = false;  
    protected $keyType = 'string';

    protected $fillable = [
        'id_semestre',
        'id_student',
        'ano_semestre',
        'data_atualiza_semestre ',
        'observacao'
    ];
}
