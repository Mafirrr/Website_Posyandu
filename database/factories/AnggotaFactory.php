<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('###############'),
            'password' => Hash::make('password123'),
            'nama' => $this->faker->name(),
            'tanggal_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city(),
            'pekerjaan' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'no_telepon' => $this->faker->unique()->numerify('+628#############'), // 13 digit
            'golongan_darah' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
