<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'material_id' => rand(1,3),
            'category_id' => rand(1,3),
            'image' => $this->faker()->word(),
            'slug' => $this->faker()->slug(3),
            'author' => $this->faker()->name(),
            'tittle' => $this->faker()->tittle(),
            'excerpt' => $this->faker()->sentences(rand(5,20)),
            'body' => $this->faker()->paragraphs(rand(4,10))
        ];
    }
}
