<?php

namespace Database\Seeders;

use App\Models\IngredientTranslation;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ingredient::factory()
        ->has(IngredientTranslation::factory()->sequence(['locale' => 'hr'],
        ['locale' => 'en'],['locale'=>'fr'])->count(3))
        ->count(10)
        ->create();
    }
}
