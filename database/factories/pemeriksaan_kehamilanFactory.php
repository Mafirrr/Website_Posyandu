<?php

namespace Database\Factories;

use App\Models\Kehamilan;
use App\Models\Petugas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class pemeriksaan_kehamilanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->randomElement([2023, 2025]);
        if ($year == 2025) {
            $month = $this->faker->numberBetween(1, 5);
        } else {
            $month = $this->faker->numberBetween(1, 12);
        }
        $day = $this->faker->numberBetween(1, 28);
        $tanggalPeriksa = sprintf('%04d-%02d-%02d', $year, $month, $day);

        return [
            'kehamilan_id' => 2,
            'petugas_id' => Petugas::factory(),
            'tanggal_periksa' => $tanggalPeriksa,
            'tempat_periksa' => $this->faker->city(),
            'berat_badan' => $this->faker->randomFloat(1, 40, 120),
            'lingkar_lengan_atas' => $this->faker->randomFloat(1, 15, 40),
            'tekanan_darah_atas' => $this->faker->numberBetween(90, 160),
            'tekanan_darah_bawah' => $this->faker->numberBetween(60, 100),
            'tinggi_rahim' => $this->faker->randomFloat(1, 10, 40),
            'denyut_jantung_janin' => $this->faker->numberBetween(110, 160),
            'status_imunisasi_tetanus' => $this->faker->randomElement(['lengkap', 'belum lengkap', 'tidak tahu']),
            'konseling' => $this->faker->sentence(10),
            'skrining_dokter' => $this->faker->randomElement(['normal', 'tidak_normal']),
            'tambah_darah' => $this->faker->randomElement(['ya', 'tidak']),
            'usg' => $this->faker->randomElement(['ya', 'tidak']),
            'ppia' => $this->faker->randomElement(['ya', 'tidak']),
            'tata_laksana_kasus' => $this->faker->paragraph(2),
        ];
    }

}
