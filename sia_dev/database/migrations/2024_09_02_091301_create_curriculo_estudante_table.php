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
        Schema::create('matricula', function (Blueprint $table) {
            $table->uuid('id_matricula')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_student');
            $table->uuid('id_programa_estudo');
            $table->uuid('id_semestre');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('status', 50)->checkIn(['Ativo', 'Concluído', 'Desistiu']);

            $table->foreign('id_student')->references('id_student')->on('students');
            $table->foreign('id_programa_estudo')->references('id_programa_estudo')->on('programa_estudo');
            $table->foreign('id_semestre')->references('id_semestre')->on('semestre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricula');
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
