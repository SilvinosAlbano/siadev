<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estatuto_funcionario', function (Blueprint $table) {
            $table->uuid('id_estatuto_funcionario')->primary(); // Set as primary key and UUID type
            $table->uuid('id_funcionario'); 
            $table->uuid('id_estatuto'); 
            $table->date('data_inicio');
            $table->date('data_fim');    
            $table->string('estatuto_funcionario')->nullable();            
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
        Schema::dropIfExists('estatuto_funcionario');
    }
};
