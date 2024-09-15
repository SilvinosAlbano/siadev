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
        Schema::create('semestre', function (Blueprint $table) {
            $table->uuid('id_semestre')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->integer('numero_semestre');
            $table->integer('ano_academico');
            $table->uuid('id_programa_estudo');
            $table->foreign('id_programa_estudo')->references('id_programa_estudo')->on('programa_estudo');
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestre');
    }
};
