<?php

namespace Database\Factories;

use App\Models\kategori;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artikel>
 */
class ArtikelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = $this->faker->sentence(6);

        return [
            'judul' => $judul,
            'slug' => Str::slug($judul),
            'isi' => $this->faker->paragraphs(3, true),
            'gambar' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'), // contoh gambar random
            'kategori_id' => kategori::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
