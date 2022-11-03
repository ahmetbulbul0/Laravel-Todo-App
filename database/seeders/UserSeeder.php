<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(5)
            ->hasTodo(10)
            ->create();

            User::factory()
            ->count(10)
            ->create();

            User::factory()
            ->count(2)
            ->hasTodo(14)
            ->create();

            User::factory()
            ->count(2)
            ->hasTodo(20)
            ->create();

            User::factory()
            ->count(10)
            ->hasTodo(4)
            ->create();
    }
}
