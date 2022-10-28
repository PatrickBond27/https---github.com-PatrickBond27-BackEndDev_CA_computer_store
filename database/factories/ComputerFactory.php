<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(80),
            'brand' => $this->faker->text(20),
            'graphics_card' => $this->faker->text(20),
            'processor' => $this->faker->text(20),
            'storage' => $this->faker->word,
            'ram' => $this->faker->word,
            'price' => $this->faker->numberBetween(300, 5000),
        ];
    }
}
