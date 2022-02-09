<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exam_id' => rand(1,3),
            'question' => $this->faker->sentence(40),
            'opt_a' => $this->faker->sentence(5),
            'opt_b' => $this->faker->sentence(5),
            'opt_c' => $this->faker->sentence(5),
            'opt_d' => $this->faker->sentence(5),
            'opt_e' => $this->faker->sentence(5),
            'key' => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e']),
            'explanation' => $this->faker->sentence(mt_rand(5, 20))
        ];
    }
}
