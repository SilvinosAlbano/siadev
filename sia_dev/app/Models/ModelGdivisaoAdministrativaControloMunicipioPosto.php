<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelGdivisaoAdministrativaControloMunicipioPosto extends Model
{
    protected $table = 'gdivisao_administrativa_controlo_municipio_posto';
    protected $primaryKey = 'id_contolo_municipio_posto';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_posto_administrativo',
        'id_municipio',
        'data_inicio',
        'data_fim',
        'controlo_ativo',
        'gdamp_inserido_por',
        'gdamp_inserido_em',
        'gdamp_ultima_alteracao_por',
        'gdamp_ultima_alteracao_em',
        'descricao'
    ];

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(ModelGdivisaoAdministrativaMunicipio::class, 'id_municipio');
    }

    public function postoAdministrativo(): BelongsTo
    {
        return $this->belongsTo(ModelGdivisaoAdministrativaPostoAdministrativo::class, 'id_posto_administrativo');
    }
}
