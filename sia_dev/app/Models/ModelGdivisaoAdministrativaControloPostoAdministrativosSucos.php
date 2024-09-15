<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelGdivisaoAdministrativaControloPostoAdministrativosSucos extends Model
{ // Define the table if it doesn't follow Laravel's naming convention
    protected $table = 'gdivisao_administrativa_controlo_posto_administrativos_sucos';

    // Define the primary key field (since you're using UUIDs)
    protected $primaryKey = 'id_controlo_posto_administrativo_sucos';
    public $incrementing = false;  // Disable auto-increment since UUIDs are not incremental

    // Define the key type (UUIDs are strings)
    protected $keyType = 'string';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'id_posto_administrativo',
        'id_sucos',
        'data_inicio',
        'data_fim',
        'controlo_ativo',
        'gdals_inserido_por',
        'gdals_inserido_em',
        'gdals_ultima_alteracao_por',
        'gdals_ultima_alteracao_em',
        'descricao',
    ];

    // Define relationships
    public function postoAdministrativo(): BelongsTo
    {
        return $this->belongsTo(ModelGdivisaoAdministrativaPostoAdministrativo::class, 'id_posto_administrativo', 'id_posto_administrativo');
    }

    public function sucos(): BelongsTo
    {
        return $this->belongsTo(ModelGdivisaoAdministrativaSucos::class, 'id_sucos', 'id_sucos');
    }
}
