<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petugas>
 */
class PetugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('19########'),
            'nama' => "Rani Selvia",
            'no_telepon' => fake()->unique()->numerify('08###########'),
            'email' => "jedurekos@gmail.com",
            'password' => Hash::make('admin123'),
            'role' => fake()->randomElement(['kader'])
        ];
    }
}
