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
            'material_id' => mt_rand(1,3),
            'category_id' => mt_rand(1,2),
            'image' => 'default',
            'slug' => $this->faker->slug(),
            'tittle' => $this->faker->sentence(mt_rand(1,3)),
            'excerpt' => $this->faker->paragraph(mt_rand(1,2)),
            'quantity' => mt_rand(1,20),
        ];
    }
}
