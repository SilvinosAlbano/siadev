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
        Schema::create('docente_materia', function (Blueprint $table) {
            $table->uuid('id_docente_materia')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_funcionario');
            $table->uuid('id_materia');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('status', 50)->checkIn(['Ativo', 'Concluído', 'Desistiu']);
            $table->foreign('id_funcionario')->references('id_funcionario')->on('funcionario');
            $table->foreign('id_materia')->references('id_materia')->on('materia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docente_materia');
    }
};


/* 
DO $$ 
DECLARE 
    r RECORD;
BEGIN 
    FOR r IN (SELECT tablename FROM pg_tables WHERE schemaname = 'public') 
    LOOP 
        EXECUTE 'DROP TABLE IF EXISTS public.' || r.tablename || ' CASCADE;'; 
    END LOOP; 
END $$; 
*/
