<?php

namespace Database\Seeders;

use App\Models\PemeriksaanTrimester1;
use Illuminate\Database\Seeder;

class PemeriksaanTrimester1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PemeriksaanTrimester1::factory()->count(1)->create();
    }
}
