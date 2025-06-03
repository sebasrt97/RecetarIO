<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Receta;
use App\Models\User;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Usuario Seeder',
                'email' => 'seeder@example.com', // Asegúrate que este email sea diferente al de tu UserSeeder principal si ese crea admin@example.com
                'password' => bcrypt('password'),
            ]);
        }

        Receta::create([
            'user_id' => $user->id,
            'nombre' => 'Paella Valenciana Clásica',
            'descripcion' => 'La auténtica paella valenciana con pollo, conejo y verduras frescas. Un plato tradicional lleno de sabor.',
            'instrucciones' => json_encode([ 
                'Sofreír la carne de pollo y conejo en la paella con aceite hasta que dore.',
                'Añadir las verduras (garrofón, judía verde) y sofreír unos minutos más.',
                'Incorporar el tomate rallado y cocinar hasta que reduzca.',
                'Añadir el arroz, el azafrán, el pimentón y el agua. Cocinar a fuego fuerte 10 minutos.',
                'Reducir el fuego y cocinar a fuego lento hasta que el arroz absorba el agua y esté cocido (aprox. 8-10 minutos).',
                'Dejar reposar 5 minutos antes de servir.'
            ]),
            'tiempo_preparacion' => 30, 
            'tiempo_coccion' => 45,  
            'porciones' => 4,
            'dificultad' => 'Media',
            'margen_beneficio' => 0.25, 
            'imagen' => 'recetas/platop.png',
        ]);

        Receta::create([
            'user_id' => $user->id,
            'nombre' => 'Ensalada Mediterránea',
            'descripcion' => 'Una ensalada fresca y saludable con ingredientes típicos del Mediterráneo: tomate, pepino, cebolla, aceitunas y queso feta.',
            'instrucciones' => json_encode([
                'Lavar y cortar todos los vegetales en trozos medianos.',
                'En un bol grande, combinar el tomate, pepino, cebolla roja y aceitunas.',
                'Añadir el queso feta desmenuzado por encima.',
                'Aderezar con aceite de oliva virgen extra, vinagre de vino tinto, sal y pimienta al gusto.',
                'Mezclar suavemente y servir inmediatamente.'
            ]),
            'tiempo_preparacion' => 15,
            'tiempo_coccion' => 0,
            'porciones' => 2,
            'dificultad' => 'Fácil',
            'margen_beneficio' => 0.40,
            'imagen' => 'recetas/ensalada-mediterranea.jpg',
        ]);
    }
}
