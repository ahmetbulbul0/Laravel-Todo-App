<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $full_name = $this->faker->name();
        $username = Str::slug($full_name);
        $password = $this->faker->password(5, 10);
        $email = $this->faker->email();
        $type = "user";

        return [
            'full_name' => $full_name,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'type' => $type,
        ];
    }
}
