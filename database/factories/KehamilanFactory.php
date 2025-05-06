<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kehamilan>
 */
class KehamilanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anggota_id' => '3',
            'tanggal_awal' => $this->faker->date(),
            'usia_kehamilan_awal' => $this->faker->numberBetween(1, 40),
            'riwayat_penyakit' => $this->faker->sentence(),
            'riwayat_kehamilan' => $this->faker->sentence(),
            'perkiraan_kehamilan' => $this->faker->date(),
            'status' => $this->faker->randomElement(['proses', 'keguguran']),
        ];
    }
}
