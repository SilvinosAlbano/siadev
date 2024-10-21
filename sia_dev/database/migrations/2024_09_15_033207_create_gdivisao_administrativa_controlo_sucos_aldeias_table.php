<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gdivisao_administrativa_controlo_sucos_aldeias', function (Blueprint $table) {
            $table->uuid('id_contolo_sucos_aldeias')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_aldeias');
            $table->uuid('id_sucos');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('controlo_ativo')->nullable();
            $table->string('gdals_inserido_por')->nullable();
            $table->string('gdals_inserido_em')->nullable();
            $table->string('gdals_ultima_alteracao_por')->nullable();
            $table->string('gdals_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->foreign('id_aldeias')->references('id_aldeias')->on('gdivisao_administrativa_aldeias');
            $table->foreign('id_sucos')->references('id_sucos')->on('gdivisao_administrativa_sucos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gdivisao_administrativa_controlo_sucos_aldeias');
    }
};
