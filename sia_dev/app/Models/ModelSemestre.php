<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSemestre extends Model
{
    use HasFactory;

    protected $table = 'semestre';
    protected $primaryKey = 'id_semestre';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['numero_semestre', 'ano_academico', 'id_programa_estudo'];

    // Relationships
    public function programaEstudo()
    {
        return $this->belongsTo(ModelProgramaEstudo::class, 'id_programa_estudo', 'id_programa_estudo');
    }
}
