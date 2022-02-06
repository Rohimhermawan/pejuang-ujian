<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
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
            'slug' => $this->faker()->slug(rand(1,3)),
            'tittle' => $this->faker()->tittle(),
            'excerpt' => $this->faker()->sentences(rand(10,25)),
            'quantity' => rand(1,20),
        ];
    }
}
