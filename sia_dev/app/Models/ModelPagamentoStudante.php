<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPagamentoStudante extends Model
{
    use HasFactory;

    protected $table = 'pagamento_estudante';
    protected $primaryKey = 'id_pagamento_estudante';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['id_student', 'id_controlo_departamento','id_semestre','data_selu','tipo_selu','selu_total','falta','observacao','estado'];
}
