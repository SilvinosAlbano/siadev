<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFinalista extends Model
{
    use HasFactory;
    protected $table = 'estudante_finalista';
    protected $primaryKey = 'id_finalista';
    public $incrementing = false;  
    protected $keyType = 'string';

    protected $fillable = [
      
        'id_student',
        'ano_academico',
        'estatus',
        'observacao'
    ];
}
