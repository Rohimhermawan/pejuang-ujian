<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Category;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'name' => "Rohim Hermawan",
            'email' => "rohimhermawan01@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make("muhamad123"),
            'remember_token' => Str::random(10),
        ]);
        Post::factory(20)->create();
        Exam::factory(3)->create();
        Question::factory(100)->create();

    }
}
