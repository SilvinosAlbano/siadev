<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioEstatutoModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_estatuto_funcionario';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'estatuto_funcionario';

    protected $fillable = [
        'id_estatuto_funcionario',
        'id_estatuto',
        'id_funcionario',
        'data_inicio',
        'data_fim'
        
    ];
}
