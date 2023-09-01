<?php

namespace Database\Seeders;

use App\Models\TagTranslation;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Tag::factory()
        ->has(TagTranslation::factory()->sequence(['locale' => 'hr'],
        ['locale' => 'en'],['locale'=>'fr'])->count(3))
        ->count(10)
        ->create();
    }
}
