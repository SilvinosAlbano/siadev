<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ModelFuncionarioDepartamento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_departamento_funcionario';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'departamento_funcionario';

    protected $fillable = [
        'id_departamento_funcionario',
        'id_departamento',
        'id_funcionario',   
        'data_inicio',    
        'data_fim', 
        
    ];
}
