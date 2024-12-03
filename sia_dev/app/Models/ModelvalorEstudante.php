<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelvalorEstudante extends Model
{
    use HasFactory;
    protected $table = 'valor_estudante';
    protected $primaryKey = 'id_valor';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_student',
        'id_materia_semestre',
        'valor',
        'observacao',
    ];
}
