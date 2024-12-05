<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelNaturalidadeEstudante extends Model
{
    use HasFactory;
    protected $table = 'naturalidade_estudante';
    protected $primaryKey = 'id_naturalidade_studante';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_naturalidade_studante',
        'id_student',
        'id_municipio',
        'id_posto_administrativo',
        'id_suco',
        'id_aldeias',
        'nacionalidade',
        'endereco_atual',
        'observacao'

        
    ];
}
