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
        Schema::create('habilitacao', function (Blueprint $table) {
            $table->uuid('id_habilitacao')->primary()->default(DB::raw('gen_random_uuid()')); // Set as primary key and UUID type
            $table->uuid('id_funcionario');     
            $table->string('habilitacao')->nullable(); 
            $table->string('universidade_origem')->nullable();    
            $table->string('controlo_estado')->nullable();
            
            // Add timestamps (created_at, updated_at)
            $table->timestamps();
    
            // Add soft deletes (deleted_at)
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilitacao');
    }
};