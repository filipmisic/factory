<?php

namespace Database\Seeders;

use App\Models\CategoryTranslation;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::factory()
        ->has(CategoryTranslation::factory()->sequence(['locale' => 'hr'],
        ['locale' => 'en'],['locale'=>'fr'])->count(3))
        ->count(5)
        ->create();
    }
}
