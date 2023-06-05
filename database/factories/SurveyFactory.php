<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
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
            'owner_id' => $this->faker->numberBetween(1, 20),
            'edit_password' => Hash::make('edit'),
            'access_password' => $this->faker->randomElement([null, 'access']),
            'start_date' => $this->faker->randomElement([null, date('Y-m-d H:i:s', time())]),
            'end_date' => $this->faker->randomElement([null, date('Y-m-d H:i:s', time())]),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
