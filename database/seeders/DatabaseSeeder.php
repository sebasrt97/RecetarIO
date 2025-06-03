<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Receta;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            RecetaSeeder::class,// Otros seeders si los tienes, por ejemplo: CategoriaSeeder::class, 
            AlergenoSeeder::class,
            IngredienteSeeder::class,
            // Otros seeders si los tienes, por ejemplo: CategoriaSeeder::class,
        ]);

    }
}