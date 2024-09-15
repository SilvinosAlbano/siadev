<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUnidadeCurricular extends Model
{
    use HasFactory;

    protected $table = 'unidade_curricular';

    protected $primaryKey = 'id_unidade_curricular';

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'id_unidade_curricular',
        'unidade_curricular',
        'creditos',
        'id_semestre',
    ];

    public function semestre()
    {
        return $this->belongsTo(ModelSemestre::class, 'id_semestre', 'id_semestre');
    }
}
