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
        Schema::create('materia_semestre', function (Blueprint $table) {
            $table->uuid('id_materia_semestre')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_semestre');
            $table->uuid('id_materia');
            $table->foreign('id_semestre')->references('id_semestre')->on('semestre');
            $table->foreign('id_materia')->references('id_materia')->on('materia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_semestre');
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
