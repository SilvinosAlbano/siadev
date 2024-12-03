<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLicencaEstudante extends Model
{
    use HasFactory;
    protected $table = 'licenca_estudante';
    protected $primaryKey = 'id_licensa_estudante';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_licensa_estudante',
        'id_funcionario',
        'id_tipo_licensa',
        'data_inicio_licensa',
        'data_fim_licensa',
        'observacao',
        'estado'
    ];
}
