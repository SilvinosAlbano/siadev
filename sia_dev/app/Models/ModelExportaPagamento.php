<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelExportaPagamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_student';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'view_monitoramento_pagamento_estudante';

   
}
