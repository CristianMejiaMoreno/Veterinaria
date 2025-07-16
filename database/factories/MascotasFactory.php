<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mascotas>
 */
class MascotasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'especie_id'=>$this->faker->numberBetween(1,20),
            'raza_id'=>$this->faker->numberBetween(1,20),
            'cliente_id'=>$this->faker->numberBetween(1,20),
            'nombre'=>$this->faker->firstName(),
            'fecha_nacimiento'=>$this->faker->dateTimeBetween('-15 years', '-1 year'),
            'edad'=>$this->faker->numberBetween(1, 14),
            'sexo'=>$this->faker->boolean()
        ];
    }
}
