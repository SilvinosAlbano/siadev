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
        Schema::create('tipo_categoria_admin', function (Blueprint $table) {
            $table->uuid('id_tipo_categoria')->primary(); // Set as primary key and UUID type
            $table->string('tipo_categoria');          
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
        //
        Schema::dropIfExists('tipo_categoria_admin');
    }
};
