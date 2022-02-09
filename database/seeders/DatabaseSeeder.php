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
            'name' => 'SBMPTN',
            'slug' => 'sbmptn'
        ]);
        Category::create([
            'name' => 'CPNS',
            'slug' => 'cpns'
        ]);
        Material::create([
            'name' => 'Matematika',
            'slug' => 'matematika'
        ]);
        Material::create([
            'name' => 'Kimia',
            'slug' => 'kimia'
        ]);
        Material::create([
            'name' => 'B. Indonesia',
            'slug' => 'b-indonesia'
        ]);
        Post::factory(20)->create();
        Exam::factory(3)->create();
        Question::factory(100)->create();

    }
}
