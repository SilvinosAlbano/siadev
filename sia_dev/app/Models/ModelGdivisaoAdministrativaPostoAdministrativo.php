<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelGdivisaoAdministrativaPostoAdministrativo extends Model
{
    protected $table = 'gdivisao_administrativa_posto_administrativo';
    protected $primaryKey = 'id_posto_administrativo';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'posto_administrativo',
        'codigo_posto_administrativo',
        'codigo_financa',
        'gdp_inserido_por',
        'gdp_inserido_em',
        'gdp_ultima_alteracao_por',
        'gdp_ultima_alteracao_em',
        'descricao',
        'data_inicio_posto_administrativo',
        'data_fim_posto_administrativo'
    ];

    public function controloPostoAdministrativosSucos(): HasMany
    {
        return $this->hasMany(ModelGdivisaoAdministrativaControloPostoAdministrativosSucos::class, 'id_posto_administrativo');
    }
}
