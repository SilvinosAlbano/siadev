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
        Schema::create('programa_estudo', function (Blueprint $table) {
            $table->uuid('id_programa_estudo')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_departamento');
            $table->foreign('id_departamento')->references('id_departamento')->on('departamento');
            $table->string('nome_programa', 255);
            $table->integer('duracao_anos')->checkBetween(1, 6);
            $table->string('tipo_programa', 255);  // e.g., 'Licenciatura', 'Bacharelato'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_estudo');
    }
};
