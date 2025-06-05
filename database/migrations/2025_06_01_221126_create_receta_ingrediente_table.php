<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. Relacion: una receta puede tener varios ingredientes
     */
    public function up(): void
    {
        Schema::create('receta_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receta_id')
                ->constrained('recetas')
                ->onDelete('cascade');
            $table->foreignId('ingrediente_id')
                ->constrained('ingredientes')
                ->onDelete('cascade');
            $table->decimal('cantidad_bruta', 8, 2);
            $table->string('unidad_receta_medida');
            
            // Tabla intermedia para la relación muchos a muchos entre recetas e ingredientes
            $table->unique(['receta_id', 'ingrediente_id'], 'receta_ingrediente_unique');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receta_ingrediente');
    }
};
