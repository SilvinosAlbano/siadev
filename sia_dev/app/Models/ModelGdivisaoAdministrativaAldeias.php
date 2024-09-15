<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelGdivisaoAdministrativaAldeias extends Model
{
    protected $table = 'gdivisao_administrativa_aldeias';
    protected $primaryKey = 'id_aldeias';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'aldeias',
        'codigo_aldeias',
        'codigo_financa',
        'gda_inserido_por',
        'gda_inserido_em',
        'gda_ultima_alteracao_por',
        'gda_ultima_alteracao_em',
        'descricao',
        'data_inicio_aldeias',
        'data_fim_aldeias'
    ];

    public function controloSucosAldeias(): HasMany
    {
        return $this->hasMany(ModelGdivisaoAdministrativaControloSucosAldeias::class, 'id_aldeias');
    }
}
