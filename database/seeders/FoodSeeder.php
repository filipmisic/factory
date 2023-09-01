<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FoodTranslation;
use App\Models\Ingredient;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag= Tag::all();
        $category = Category::all();
       $ingredient = Ingredient::all();

       \App\Models\Food::factory()
       ->has(FoodTranslation::factory()->sequence(['locale' => 'hr'],
       ['locale' => 'en'],['locale'=>'fr'])->count(3))
       ->state(new Sequence(
           fn (Sequence $sequence) => ['category_id' => $this->getRandOrNull($category)],
       ))
       ->count(50)
       ->create()->each(function($food) use ($tag) {
           $food->tags()->attach(
               $tag->random(rand(1, 5))->pluck('id')->toArray()
           );
       },)
       ->each(function($food) use ($ingredient) {
           $food->ingredients()->attach(
               $ingredient->random(rand(1, 5))->pluck('id')->toArray()
           );
       },);
       
    }

    protected function getRandOrNull($category){
        switch (rand(0,1)){
            case 0:
                return null;
            case 1:
                return $category->random();
        }
    }
}
