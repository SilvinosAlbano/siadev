<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGdivisaoAdministrativaMunicipioTable extends Migration
{
    public function up()
    {
        Schema::create('gdivisao_administrativa_municipio', function (Blueprint $table) {
            $table->uuid('id_municipio')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('municipio');
            $table->string('codigo_municipio')->nullable();
            $table->string('codigo_financa')->nullable();
            $table->text('gdam_inserido_por')->nullable();
            $table->string('gdam_inserido_em')->nullable();
            $table->string('gdam_ultima_alteracao_por')->nullable();
            $table->string('gdam_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->string('id_municipio_ktl', 36)->nullable();
            $table->date('data_inicio_municipio')->nullable();
            $table->date('data_fim_municipio')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gdivisao_administrativa_municipio');
    }
}
