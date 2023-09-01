<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::factory()->sequence(['lang' => 'hr'],
        ['lang' => 'en'],['lang'=>'fr'])->count(3)
        ->create();
    }
}
