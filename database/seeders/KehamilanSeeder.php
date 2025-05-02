<?php

namespace Database\Seeders;

use App\Models\Kehamilan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KehamilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kehamilan::factory()->count(10)->create(); 
    }
}
