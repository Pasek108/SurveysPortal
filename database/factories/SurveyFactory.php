<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surveys>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->bothify('#?#?##??#'),
            'owner_id' => $this->faker->numberBetween(1, 20),
            'edit_password' => $this->faker->password(),
            'access_password' => $this->faker->password(),
            'start_date' => date('Y-m-d H:i:s',time()),
            'end_date' => date('Y-m-d H:i:s',time()),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
