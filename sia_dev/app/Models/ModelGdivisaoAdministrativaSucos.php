<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelGdivisaoAdministrativaSucos extends Model
{
    protected $table = 'gdivisao_administrativa_sucos';
    protected $primaryKey = 'id_sucos';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'sucos',
        'codigo_sucos',
        'codigo_financa',
        'gds_inserido_por',
        'gds_inserido_em',
        'gds_ultima_alteracao_por',
        'gds_ultima_alteracao_em',
        'descricao',
        'data_inicio_sucos',
        'data_fim_sucos'
    ];

    public function controloPostoAdministrativosSucos(): HasMany
    {
        return $this->hasMany(ModelGdivisaoAdministrativaControloPostoAdministrativosSucos::class, 'id_sucos');
    }

    public function controloSucosAldeias(): HasMany
    {
        return $this->hasMany(ModelGdivisaoAdministrativaControloSucosAldeias::class, 'id_sucos');
    }
}
