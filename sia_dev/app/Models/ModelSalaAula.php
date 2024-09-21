<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSalaAula extends Model
{
    use HasFactory;
    protected $table = 'salas';
    protected $primaryKey = 'id_sala';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_sala',
        'nome_sala',
         'observacao'
    ];
}
