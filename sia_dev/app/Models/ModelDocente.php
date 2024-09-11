<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Eloquent\SoftDeletes;

class ModelDocente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_docente';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'docentes';
    // use SoftDeletes; // Enables soft deletes
    
    // Other model code...

    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_docente',
        'nome_docente',
        'sexo',
        'id_suco',
        'id_posto_administrativo',
        'id_municipio',
        'data_moris',
        'nacionalidade',
        'nivel_educacao',
        'area_especialidade',
        'universidade_origem',
        'ano_inicio',
        'id_estatuto',
        'id_departamento',
        'id_tipo_categoria',
        'observacao',
        'categoria',
        'photo_docente'
    ];

    public function getAllData() 
    {
        return DB::table('tipo_categoria_admin')
            ->select('*')
            ->orderBy('id_tipo_categoria', 'asc')
            ->get();
    }
}
