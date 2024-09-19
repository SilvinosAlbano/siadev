<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelMateria extends Model
{
    protected $table = 'materia';
    protected $primaryKey = 'id_materia';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_materia',
        'materia',
        'codigo_materia',
        'credito'
    ];

    // Relacionamento com MateriaSemestre
    public function materiasSemestre()
    {
        return $this->hasMany(ModelMateriaSemestre::class, 'id_materia', 'id_materia');
    }
}
