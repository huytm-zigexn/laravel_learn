<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\Group::factory()
            ->count(10)
            ->hasTasks(5) // Each group has 5 tasks
            ->create();

        \App\Models\User::factory()
            ->count(10)
            ->create();
    }

}
