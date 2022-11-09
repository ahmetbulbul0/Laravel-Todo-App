<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $content = $this->faker->paragraph();
        $user = $this->faker->randomElement(User::all());
        $added_time = now();
        $is_completed = $this->faker->randomElement([true, false]);


        return [
            "content" => $content,
            "user" => $user,
            "added_time" => $added_time,
            "is_completed" => $is_completed
        ];
    }
}
