<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Raza>
 */
class RazaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'especie_id'=>$this->faker->numberBetween(1,100),
            'nombre'=>$this->faker->name(),
            'rasgos'=>$this->faker->text()
        ];
    }
}
