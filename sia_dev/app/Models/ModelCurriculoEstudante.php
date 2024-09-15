<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCurriculoEstudante extends Model
{
    use HasFactory;

    protected $table = 'curriculo_student';

    protected $primaryKey = 'id_curriculo_student';
    public $incrementing = false;
    protected $keyType = 'string'; // Assuming UUIDs are used

    protected $fillable = [
        'id_student',
        'id_programa_estudo',
        'id_semestre',
        'data_inicio',
        'data_fim',
        'status'
    ];

    // Define the relationship with ModelStudent
    public function student()
    {
        return $this->belongsTo(ModelStudent::class, 'id_student', 'id_student');
    }

    // Define the relationship with ModelProgramaEstudo
    public function programaEstudo()
    {
        return $this->belongsTo(ModelProgramaEstudo::class, 'id_programa_estudo');
    }

    // Define the relationship with ModelSemestre
    public function semestre()
    {
        return $this->belongsTo(ModelSemestre::class, 'id_semestre');
    }
}
