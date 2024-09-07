<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelEstatuto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_estatuto';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'tipo_estatuto';

    protected $fillable = [
        'id_estatuto',
        'estatuto'
        
    ];
}
