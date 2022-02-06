<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Exam;
use App\Models\Question;

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
            'nama' => 'SBMPTN'
        ]);
        Category::create([
            'nama' => 'CPNS'
        ]);
        Material::create([
            'nama' => 'Matematika'
        ]);
        Material::create([
            'nama' => 'Kimia'
        ]);
        Material::create([
            'nama' => 'B. Indonesia'
        ]);
        Post::factory(10)->create();
        Exam::factory(3)->create();
        Question::factory(100)->create();

    }
}
