<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PemeriksaanTrimester3>
 */
class PemeriksaanTrimester3Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kehamilan_id' => \App\Models\Kehamilan::factory(), // atau pakai ID yang sudah ada
            'petugas_id' => \App\Models\Petugas::factory(),
            'tanggal_pemeriksaan' => $this->faker->date(),
            'konjungtiva' => $this->faker->word(),
            'sklera' => $this->faker->word(),
            'kulit' => $this->faker->word(),
            'leher' => $this->faker->word(),
            'gigi_mulut' => $this->faker->word(),
            'tht' => $this->faker->word(),
            'jantung' => $this->faker->word(),
            'paru' => $this->faker->word(),
            'perut' => $this->faker->word(),
            'tungkai' => $this->faker->word(),
            'janin' => $this->faker->word(),
            'jumlah_janin' => $this->faker->numberBetween(1, 3),
            'letak_janin' => $this->faker->word(),
            'berat_janin' => $this->faker->randomFloat(2, 1.0, 5.0),
            'plasenta' => $this->faker->word(),
            'usia_kehamilan' => $this->faker->numberBetween(4, 12),
            'protein_urine' => $this->faker->word(),
            'urine_produksi' => $this->faker->word(),
            'rencana_konsultasi_lanjut' => $this->faker->sentence(),
            'rencana_persalinan' => $this->faker->sentence(),
            'rencana_kontrasepsi' => $this->faker->sentence(),
            'konseling' => $this->faker->sentence(),
        ];
    }
}
