<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingrediente>
 */
class IngredienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>this->faker->unique()->word(),
            'precio'=> $this->faker->randomFloat(2, 0, 100),
            'unidad_receta_medida' => $this->faker->randomElement(['kg', 'g', 'l', 'ml']),
            'porcentaje_merma' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
