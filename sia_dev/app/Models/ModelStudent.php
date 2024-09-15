<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModelStudent extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'id_student';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_student',
        'complete_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'nre',
        'start_year',
        'student_image',
        'observation',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_student)) {
                $model->id_student = (string) Str::uuid();
            }
        });
    }

    public function curriculoEstudante()
    {
        return $this->hasOne(ModelCurriculoEstudante::class, 'id_student');
    }
    public function programasEstudo()
    {
        return $this->hasManyThrough(
            ModelProgramaEstudo::class,
            ModelCurriculoEstudante::class,
            'id_student', // Foreign key on ModelCurriculoEstudante
            'id_programa_estudo', // Foreign key on ModelProgramaEstudo
            'id_student', // Local key on ModelStudent
            'id_programa_estudo' // Local key on ModelCurriculoEstudante
        );
    }

    public function departamentos()
    {
        return $this->hasManyThrough(
            ModelDepartamento::class,
            ModelProgramaEstudo::class,
            'id_programa_estudo', // Foreign key on ModelProgramaEstudo
            'id_departamento', // Foreign key on ModelDepartamento
            'id_student', // Local key on ModelStudent
            'id_programa_estudo' // Local key on ModelProgramaEstudo
        );
    }

    public function semestres()
    {
        return $this->hasManyThrough(
            ModelSemestre::class,
            ModelProgramaEstudo::class,
            'id_programa_estudo', // Foreign key on ModelProgramaEstudo
            'id_semestre', // Foreign key on ModelSemestre
            'id_student', // Local key on ModelStudent
            'id_semestre' // Local key on ModelProgramaEstudo
        );
    }
}
