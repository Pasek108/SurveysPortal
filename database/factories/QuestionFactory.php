<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questions>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'survey_id' => $this->faker->numberBetween(1, 20),
            'question' => $this->faker->paragraph(),
            'description' => $this->faker->text(),
            'options' => "option1|option2|option3|option4",
            'multiple_choice' => $this->faker->numberBetween(0, 1),
        ];
    }
}