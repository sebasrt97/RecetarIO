<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alergeno;
use App\Models\Ingrediente;

class AlergenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alergenos = [
            'Gluten',
            'Crustáceos',
            'Huevos',
            'Pescado',
            'Cacahuetes',
            'Soja',
            'Lácteos',
            'Frutos de cáscara',
            'Apio',
            'Mostaza',
            'Sésamo',
            'Sulfitos',
            'Altramuces',
            'Moluscos'
        ];
        foreach ($alergenos as $nombre) {
            Alergeno::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
