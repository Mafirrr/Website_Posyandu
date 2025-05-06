<?php

namespace Database\Seeders;

use App\Models\PemeriksaanTrimester3;
use Illuminate\Database\Seeder;

class PemeriksaanTrimester3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PemeriksaanTrimester3::factory()->count(10)->create();
    }
}
