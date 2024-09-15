<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProgramaEstudo extends Model
{
    use HasFactory;
    protected $table = 'programa_estudo';
    protected $primaryKey = 'id_programa_estudo';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['id_departamento', 'nome_programa', 'duracao_anos', 'tipo_programa'];

    // Relationships
    public function departamento()
    {
        return $this->belongsTo(ModelDepartamento::class, 'id_departamento');
    }
}
