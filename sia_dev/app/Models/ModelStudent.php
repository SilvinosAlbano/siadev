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

    // Relacionamento com Matricula
    public function matriculas()
    {
        return $this->hasMany(ModelMatricula::class, 'id_student', 'id_student');
    }

    // Relacionamento através de matricula para obter semestre
    public function semestre()
    {
        return $this->hasManyThrough(
            ModelSemestre::class,
            ModelMatricula::class,
            'id_student',
            'id_semestre',
            'id_student',
            'id_semestre'
        );
    }
}
