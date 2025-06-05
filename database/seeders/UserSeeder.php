<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Support\Facades\Hash; // Para hashear la contraseña

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un usuario de ejemplo
        User::create([
            'name' => 'Usuario Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'), // Una contraseña sencilla
            'email_verified_at' => now(), // Marca el email como verificado
        ]);

        // O si quieres crear más usuarios con un factory (más avanzado):
        // User::factory(10)->create();
    }
}