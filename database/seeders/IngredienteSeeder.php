<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingrediente;
use App\Models\Alergeno;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredientes = [
            ['nombre' => 'Harina de Trigo', 'precio' => 0.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05], // Gluten
            ['nombre' => 'Gambas Frescas', 'precio' => 12.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.10], // Crustáceos
            ['nombre' => 'Huevo de Gallina', 'precio' => 0.15, 'unidad_receta_medida' => 'unidad', 'porcentaje_merma' => 0.00], // Huevos
            ['nombre' => 'Salmón Fresco', 'precio' => 8.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.08], // Pescado
            ['nombre' => 'Cacahuetes Tostados', 'precio' => 2.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.04], // Cacahuetes
            ['nombre' => 'Salsa de Soja', 'precio' => 1.50, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.01], // Soja (y a veces Gluten)
            ['nombre' => 'Leche Entera', 'precio' => 0.90, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.01], // Lácteos
            ['nombre' => 'Almendras Laminadas', 'precio' => 3.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02], // Frutos de cáscara
            ['nombre' => 'Apio Fresco', 'precio' => 0.80, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05], // Apio
            ['nombre' => 'Mostaza de Dijon', 'precio' => 1.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01], // Mostaza
            ['nombre' => 'Semillas de Sésamo', 'precio' => 1.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01], // Sésamo
            ['nombre' => 'Vino Blanco', 'precio' => 3.00, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.00], // Sulfitos
            ['nombre' => 'Harina de Altramuces', 'precio' => 4.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05], // Altramuces
            ['nombre' => 'Mejillones Frescos', 'precio' => 4.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.10], // Moluscos
            ['nombre' => 'Azúcar', 'precio' => 0.30, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Sal', 'precio' => 0.10, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Levadura', 'precio' => 0.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Aceite de oliva', 'precio' => 1.00, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Mantequilla', 'precio' => 0.80, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Queso', 'precio' => 1.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05],
            ['nombre' => 'Tomate', 'precio' => 0.40, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Cebolla', 'precio' => 0.30, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Pimiento', 'precio' => 0.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Ajo', 'precio' => 0.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Pasta', 'precio' => 0.70, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Arroz', 'precio' => 0.60, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Pollo', 'precio' => 3.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.05],
            ['nombre' => 'Carne de res', 'precio' => 4.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.06],
            ['nombre' => 'Frutas variadas', 'precio' => 2.00, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Verduras variadas', 'precio' => 1.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Especias', 'precio' => 0.25, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Hierbas aromáticas', 'precio' => 0.30, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Chocolate', 'precio' => 1.20, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.03],
            ['nombre' => 'Miel', 'precio' => 1.80, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Nueces', 'precio' => 2.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Vinagre', 'precio' => 0.40, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Salsa de tomate', 'precio' => 0.70, 'unidad_receta_medida' => 'l', 'porcentaje_merma' => 0.02],
            ['nombre' => 'Pepino', 'precio' => 0.70, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.04],
            ['nombre' => 'Aceitunas', 'precio' => 3.50, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.01],
            ['nombre' => 'Ketchup', 'precio' => 0.60, 'unidad_receta_medida' => 'kg', 'porcentaje_merma' => 0.02],
        ];

        foreach ($ingredientes as $ingrediente) {
            Ingrediente::firstOrCreate(['nombre' => $ingrediente['nombre']], $ingrediente);
        }

        $alergenosMap = Alergeno::all()->pluck('id', 'nombre')->toArray();
        // coge todos los valores de la tabla Alergenos, se crea un una coleccion asociacitiva entre nombre
        // e id y luego pasarlos a un array. 

        foreach ($ingredientes as $ingrediente) {
            $ingrediente = Ingrediente::firstOrCreate($ingrediente);

            $alergenosIds = [];


            switch ($ingrediente->nombre) {
                case 'Harina de Trigo':
                case 'Pasta': 
                    if (isset($alergenosMap['Gluten'])) {
                        $alergenosIds[] = $alergenosMap['Gluten'];
                    }
                    break;
                case 'Gambas Frescas':
                    if (isset($alergenosMap['Crustáceos'])) {
                        $alergenosIds[] = $alergenosMap['Crustáceos'];
                    }
                    break;
                case 'Huevo de Gallina':
                    if (isset($alergenosMap['Huevos'])) {
                        $alergenosIds[] = $alergenosMap['Huevos'];
                    }
                    break;
                case 'Salmón Fresco':
                case 'Pescado': 
                    if (isset($alergenosMap['Pescado'])) {
                        $alergenosIds[] = $alergenosMap['Pescado'];
                    }
                    break;
                case 'Cacahuetes Tostados':
                    if (isset($alergenosMap['Cacahuetes'])) {
                        $alergenosIds[] = $alergenosMap['Cacahuetes'];
                    }
                    break;
                case 'Salsa de Soja': 
                    if (isset($alergenosMap['Soja'])) {
                        $alergenosIds[] = $alergenosMap['Soja'];
                    }
                    if (isset($alergenosMap['Gluten'])) {
                        $alergenosIds[] = $alergenosMap['Gluten'];
                    }
                    break;
                case 'Leche Entera':
                case 'Mantequilla':
                case 'Queso':
                    if (isset($alergenosMap['Lácteos'])) {
                        $alergenosIds[] = $alergenosMap['Lácteos'];
                    }
                    break;
                case 'Almendras Laminadas':
                case 'Nueces':
                    if (isset($alergenosMap['Frutos de cáscara'])) {
                        $alergenosIds[] = $alergenosMap['Frutos de cáscara'];
                    }
                    break;
                case 'Apio Fresco':
                    if (isset($alergenosMap['Apio'])) {
                        $alergenosIds[] = $alergenosMap['Apio'];
                    }
                    break;
                case 'Mostaza de Dijon':
                    if (isset($alergenosMap['Mostaza'])) {
                        $alergenosIds[] = $alergenosMap['Mostaza'];
                    }
                    break;
                case 'Semillas de Sésamo':
                    if (isset($alergenosMap['Sésamo'])) {
                        $alergenosIds[] = $alergenosMap['Sésamo'];
                    }
                    break;
                case 'Vino Blanco':
                    if (isset($alergenosMap['Sulfitos'])) {
                        $alergenosIds[] = $alergenosMap['Sulfitos'];
                    }
                    break;
                case 'Harina de Altramuces':
                    if (isset($alergenosMap['Altramuces'])) {
                        $alergenosIds[] = $alergenosMap['Altramuces'];
                    }
                    break;
                case 'Mejillones Frescos':
                    if (isset($alergenosMap['Moluscos'])) {
                        $alergenosIds[] = $alergenosMap['Moluscos'];
                    }
                    break;
            }
            if (!empty($alergenosIds)) {
                $ingrediente->alergenos()->syncWithoutDetaching($alergenosIds);
            }
        }
    }
}
