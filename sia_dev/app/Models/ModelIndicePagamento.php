<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelIndicePagamento extends Model
{
    use HasFactory;

    protected $table = 'controlo_departamento_pagamento';
    protected $primaryKey = 'id_controlo_departamento';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_controlo_departamento',
        'id__departamento',
        'ano_academico',
        'total_indice',
        'observacao'
    ];
}
