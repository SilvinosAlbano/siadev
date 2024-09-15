<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelGdivisaoAdministrativaControloSucosAldeias extends Model
{
    protected $table = 'gdivisao_administrativa_controlo_sucos_aldeias';
    protected $primaryKey = 'id_contolo_sucos_aldeias';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_aldeias',
        'id_sucos',
        'data_inicio',
        'data_fim',
        'controlo_ativo',
        'gdals_inserido_por',
        'gdals_inserido_em',
        'gdals_ultima_alteracao_por',
        'gdals_ultima_alteracao_em',
        'descricao'
    ];

    public function sucos(): BelongsTo
    {
        return $this->belongsTo(ModelGdivisaoAdministrativaSucos::class, 'id_sucos');
    }

    public function aldeias(): BelongsTo
    {
        return $this->belongsTo(ModelGdivisaoAdministrativaAldeias::class, 'id_aldeias');
    }
}
