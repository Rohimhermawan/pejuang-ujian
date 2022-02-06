<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Category;
use App\Models\Material;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
            'name' => 'SBMPTN'
        ]);
        Category::create([
            'name' => 'CPNS'
        ]);
        Material::create([
            'name' => 'Matematika'
        ]);
        Material::create([
            'name' => 'Kimia'
        ]);
        Material::create([
            'name' => 'B. Indonesia'
        ]);
        Post::factory(20)->create();
        Exam::factory(3)->create();
        Question::factory(100)->create();

    }
}
