<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGdivisaoAdministrativaAldeiasTable extends Migration
{
    public function up()
    {
        Schema::create('gdivisao_administrativa_aldeias', function (Blueprint $table) {
            $table->uuid('id_aldeias')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('aldeias');
            $table->string('codigo_aldeias')->nullable();
            $table->text('gdal_inserido_por')->nullable();
            $table->string('gdal_inserido_em')->nullable();
            $table->text('gdal_ultima_alteracao_por')->nullable();
            $table->string('gdal_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gdivisao_administrativa_aldeias');
    }
}
