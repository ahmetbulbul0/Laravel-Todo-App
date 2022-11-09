<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::factory()
            ->count(1)
            ->state([
                'full_name' => 'todo admin',
                'username' => 'admintodo',
                'password' => Hash::make('admin1todo'),
                'email' => 'admin@todo.com',
                'type' => 'admin',
                ])
            ->create();
    }
}
