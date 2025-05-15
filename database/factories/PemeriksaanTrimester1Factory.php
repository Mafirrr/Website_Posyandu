<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PemeriksaanTrimester1>
 */
class PemeriksaanTrimester1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kehamilan_id' => '1',
            'petugas_id' => '1',
            'tanggal_pemeriksaan' => $this->faker->date(),
            'konjungtiva' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'sklera' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'kulit' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'leher' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'gigi_mulut' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'tht' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'jantung' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'paru' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'perut' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'tungkai' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'gestational_sac' => $this->faker->randomFloat(2, 0.1, 5.0),
            'crown_rump_length' => $this->faker->randomFloat(2, 0.1, 5.0),
            'denyut_jantung_janin' => $this->faker->numberBetween(120, 160),
            'usia_kehamilan' => $this->faker->numberBetween(4, 12),
            'kantong_kehamilan' => $this->faker->boolean(),
        ];
    }
}
