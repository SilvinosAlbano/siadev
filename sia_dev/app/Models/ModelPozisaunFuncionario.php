<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPozisaunFuncionario extends Model
{
    use HasFactory;
    protected $table = 'pozisaun_funcionario';
    protected $primaryKey = 'id_pozisaun_funcionario';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_pozisaun_funcionario',
        'nome_pozisaun',
        'data_inicio',
        'data_fim',
        'estado',
        'id_funcionario'

        
    ];
}
