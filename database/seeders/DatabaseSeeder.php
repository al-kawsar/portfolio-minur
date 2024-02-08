<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();

        \App\Models\User::create([
            'name' => 'Muhammad Irfan Nur',
            'email' => 'irfan@test.com',
            'password' => bcrypt('123'),
            'role' => 1
        ]);

    }
}
