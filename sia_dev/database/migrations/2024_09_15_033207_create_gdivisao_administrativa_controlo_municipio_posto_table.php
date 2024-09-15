<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gdivisao_administrativa_controlo_municipio_posto', function (Blueprint $table) {
            $table->uuid('id_contolo_municipio_posto')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_posto_administrativo');
            $table->uuid('id_municipio');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('controlo_ativo')->nullable();
            $table->text('gdamp_inserido_por')->nullable();
            $table->string('gdamp_inserido_em')->nullable();
            $table->text('gdamp_ultima_alteracao_por')->nullable();
            $table->string('gdamp_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->foreign('id_municipio')->references('id_municipio')->on('gdivisao_administrativa_municipio');
            $table->foreign('id_posto_administrativo')->references('id_posto_administrativo')->on('gdivisao_administrativa_posto_administrativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gdivisao_administrativa_controlo_municipio_posto');
    }
};
