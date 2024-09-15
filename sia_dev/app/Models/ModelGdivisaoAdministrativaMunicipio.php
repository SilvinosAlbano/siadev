<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelGdivisaoAdministrativaMunicipio extends Model
{
    use HasFactory;
    protected $table = 'gdivisao_administrativa_municipio';
    protected $primaryKey = 'id_municipio';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'municipio',
        'codigo_municipio',
        'codigo_financa',
        'gdam_inserido_por',
        'gdam_inserido_em',
        'gdam_ultima_alteracao_por',
        'gdam_ultima_alteracao_em',
        'descricao',
        'id_municipio_ktl',
        'data_inicio_municipio',
        'data_fim_municipio'
    ];

    public function controloMunicipioPostos(): HasMany
    {
        return $this->hasMany(ModelGdivisaoAdministrativaControloMunicipioPosto::class, 'id_municipio');
    }
}
