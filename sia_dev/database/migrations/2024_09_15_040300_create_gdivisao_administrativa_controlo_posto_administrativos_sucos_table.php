<?php
/* 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gdivisao_administrativa_controlo_posto_administrativos_sucos', function (Blueprint $table) {
            $table->uuid('id_controlo_posto_administrativo')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_posto_administrativo');
            $table->uuid('id_sucos');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('controlo_ativo')->nullable();
            $table->string('gdals_inserido_por')->nullable();
            $table->string('gdals_inserido_em')->nullable();
            $table->string('gdals_ultima_alteracao_por')->nullable();
            $table->string('gdals_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();

            // Define foreign keys
            $table->foreign('id_posto_administrativo', 'custom_posto_administrativo_fk')
                ->references('id_posto_administrativo')
                ->on('gdivisao_administrativa_posto_administrativo')
                ->onDelete('cascade');

            $table->foreign('id_sucos', 'custom_sucos_fk')
                ->references('id_sucos')
                ->on('gdivisao_administrativa_sucos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gdivisao_administrativa_controlo_posto_administrativos_sucos');
    }
};
 */