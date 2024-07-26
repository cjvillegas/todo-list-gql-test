<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        # initialize data via seeders
        $this->call([
            UserSeeder::class
        ]);

        # after creating a user, create 10 new tasks
         Task::factory(10)->create();
    }
}
