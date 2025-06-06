<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Receta;
use App\Models\Alergeno;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama a otros seeders
        $this->call([
            UserSeeder::class, // ¡Asegúrate de que esta línea esté aquí!
            AlergenoSeeder::class,
            IngredienteSeeder::class,          
            RecetaSeeder::class,// Importante el orden de los seeders, ya que RecetaSeeder depende de IngredienteSeeder 
           
            
            // Otros seeders si los tienes, por ejemplo: CategoriaSeeder::class,
        ]);

    }
}