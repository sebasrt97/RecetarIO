<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. Relacion: un ingrediente puede tener varios alérgenos 
     * y un alérgeno puede estar en varios ingredientes)
     */
    public function up(): void
    {

        Schema::create('ingrediente_alergeno', function (Blueprint $table) {
            $table->primary(['ingrediente_id', 'alergeno_id']);
            $table->foreignId('ingrediente_id')
                ->constrained('ingredientes')
                ->onDelete('cascade'); 
            $table->foreignId('alergeno_id')
                ->constrained('alergenos')
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingrediente_alergeno');
    }
};
