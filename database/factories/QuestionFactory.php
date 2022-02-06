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
            'question' => $this->faker()->sentences(40),
            'opt_a' => $this->faker()->sentences(5),
            'opt_b' => $this->faker()->sentences(5),
            'opt_c' => $this->faker()->sentences(5),
            'opt_d' => $this->faker()->sentences(5),
            'opt_e' => $this->faker()->sentences(5),
            'key' => $this->faker()->randomElements(['a', 'b', 'c', 'd', 'e']),
        ];
    }
}
