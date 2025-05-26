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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();

            // Clave foránea para el usuario que crea la receta
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name'); // Nombre de la receta
            $table->text('description')->nullable(); // Descripción
            $table->longText('instructions'); // Instrucciones detalladas

            $table->integer('preparation_time')->nullable(); // Tiempo de preparación en minutos
            $table->integer('cooking_time')->nullable(); // Tiempo de cocción en minutos
            $table->integer('servings')->nullable(); // Número de porciones

            $table->string('difficulty')->nullable(); // Ej. 'Fácil', 'Media', 'Difícil'
            $table->string('image_path')->nullable(); // Ruta a la imagen de la receta

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};