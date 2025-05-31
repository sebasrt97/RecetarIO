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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Id foreign para el usuario que creó la receta y se elimina ese usuario se elimna todo 
            $table->string('nombre')->unique(); // Aseguramos que el nombre de la receta sea único y para url
            $table->text('descripcion')->nullable();  
            $table->longText('instrucciones');
            $table->integer('tiempo_preparacion')->nullable();
            $table->longText('ingredientes');
            $table->integer('tiempo_coccion')->nullable();
            $table->integer('porciones')->default(1);
            $table->string('dificultad')->default('fácil');
            $table->string('imagen')->nullable();
            $table->timestamps();
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
