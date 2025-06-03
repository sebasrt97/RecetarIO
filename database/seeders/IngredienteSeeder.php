<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingrediente;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredientes = [
            ['nombre' => 'Harina', 'precio' => 0.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05],
            ['nombre' => 'Azúcar', 'precio' => 0.30, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Sal', 'precio' => 0.10, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Levadura', 'precio' => 0.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Aceite de oliva', 'precio' => 1.00, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Mantequilla', 'precio' => 0.80, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Leche', 'precio' => 0.60, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Huevo', 'precio' => 0.15, 'unidad_receta_medida' => 'unidad', 'porcentaje_merma' => 0.00],
            ['nombre' => 'Queso', 'precio' => 1.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05],
            ['nombre' => 'Tomate', 'precio' => 0.40, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Cebolla', 'precio' => 0.30, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Pimiento', 'precio' => 0.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Ajo', 'precio' => 0.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Pasta', 'precio' => 0.70, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Arroz', 'precio' => 0.60, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Pollo', 'precio' => 3.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05],
            ['nombre' => 'Carne de res', 'precio' => 4.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.06],
            ['nombre' => 'Pescado', 'precio' => 5.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.07],
            ['nombre' => 'Frutas variadas', 'precio' => 2.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Verduras variadas', 'precio' => 1.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Especias', 'precio' => 0.25, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Hierbas aromáticas', 'precio' => 0.30, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Chocolate', 'precio' => 1.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Nueces', 'precio' => 2.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Miel', 'precio' => 1.80, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Vinagre', 'precio' => 0.40, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Salsa de tomate', 'precio' => 0.70, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Mostaza', 'precio' => 0.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Ketchup', 'precio' => 0.60, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
        ];
        foreach ($ingredientes as $ingrediente) {
            Ingrediente::firstOrCreate(['nombre' => $ingrediente['nombre']], $ingrediente);
        }
}
}