<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelNaturalidadeFuncionario extends Model
{
    use HasFactory;
    protected $table = 'naturalidade_funcionario';
    protected $primaryKey = 'id_naturalidade_funcionario';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_naturalidade_funcionario',
        'id_funcionario',
        'id_municipio',
        'id_posto_administrativo',
        'id_suco',
        'id_aldeias',
        'nacionalidade',
        'endereco_atual',
        'observacao'

        
    ];
}
