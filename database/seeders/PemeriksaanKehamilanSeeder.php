<?php

namespace Database\Seeders;

use App\Models\pemeriksaan_kehamilan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemeriksaanKehamilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pemeriksaan_kehamilan::factory()->count(1)->create();
    }
}
