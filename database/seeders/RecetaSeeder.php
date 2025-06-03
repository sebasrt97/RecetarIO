<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Receta;
use App\Models\User;
use App\Models\Ingrediente;

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

        $receta1 = Receta::create([
            'user_id' => $user->id,
            'nombre' => 'Paella Valenciana Clásica',
            'descripcion' => 'La auténtica paella valenciana con pollo, conejo y verduras frescas. Un plato tradicional lleno de sabor.',
            'instrucciones' => [ 
                'Sofreír la carne de pollo y conejo en la paella con aceite hasta que dore.',
                'Añadir las verduras (garrofón, judía verde) y sofreír unos minutos más.',
                'Incorporar el tomate rallado y cocinar hasta que reduzca.',
                'Añadir el arroz, el azafrán, el pimentón y el agua. Cocinar a fuego fuerte 10 minutos.',
                'Reducir el fuego y cocinar a fuego lento hasta que el arroz absorba el agua y esté cocido (aprox. 8-10 minutos).',
                'Dejar reposar 5 minutos antes de servir.'
            ],
            'tiempo_preparacion' => 30, 
            'tiempo_coccion' => 45,  
            'porciones' => 4,
            'dificultad' => 'Media',
            'margen_beneficio' => 0.25, 
            'imagen' => 'recetas/platop.png',
        ]);

            $harina = Ingrediente::where('nombre', 'Harina')->first();
            $tomate = Ingrediente::where('nombre', 'Tomate')->first();
            $aceite = Ingrediente::where('nombre', 'Aceite de Oliva')->first();

            $receta1->ingredientes()->attach([
            $harina->id => ['cantidad_bruta' => 0.2, 'unidad_receta_medida' => 'gr'],
            $tomate->id => ['cantidad_bruta' => 0.5, 'unidad_receta_medida' => 'gr'],
            $aceite->id => ['cantidad_bruta' => 0.05, 'unidad_receta_medida' => 'l'],
            ]);

        $receta2 = Receta::create([
            'user_id' => $user->id,
            'nombre' => 'Ensalada Mediterránea',
            'descripcion' => 'Una ensalada fresca y saludable con ingredientes típicos del Mediterráneo: tomate, pepino, cebolla, aceitunas y queso feta.',
            'instrucciones' => [
                'Lavar y cortar todos los vegetales en trozos medianos.',
                'En un bol grande, combinar el tomate, pepino, cebolla roja y aceitunas.',
                'Añadir el queso feta desmenuzado por encima.',
                'Aderezar con aceite de oliva virgen extra, vinagre de vino tinto, sal y pimienta al gusto.',
                'Mezclar suavemente y servir inmediatamente.'
            ],
            'tiempo_preparacion' => 15,
            'tiempo_coccion' => 0,
            'porciones' => 2,
            'dificultad' => 'Fácil',
            'margen_beneficio' => 0.40,
            'imagen' => 'recetas/ensalada-mediterranea.jpg',
        ]);
        $tomate = Ingrediente::where('nombre', 'Tomate')->first();
        $pepino = Ingrediente::where('nombre', 'Ajo')->first();
        $cebolla = Ingrediente::where('nombre', 'Cebolla')->first();
        $aceitunas = Ingrediente::where('nombre', 'Nueces')->first();
        $quesoFeta = Ingrediente::where('nombre', 'Queso')->first();

        $receta2->ingredientes()->attach([
            $tomate->id => ['cantidad_bruta' => 0.3, 'unidad_receta_medida' => 'kg'],
            $pepino->id => ['cantidad_bruta' => 0.2, 'unidad_receta_medida' => 'kg'],
            $cebolla->id => ['cantidad_bruta' => 0.1, 'unidad_receta_medida' => 'kg'],
            $aceitunas->id => ['cantidad_bruta' => 0.05, 'unidad_receta_medida' => 'kg'],
            $quesoFeta->id => ['cantidad_bruta' => 0.1, 'unidad_receta_medida' => 'kg'],
        ]);
    }
}
