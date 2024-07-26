<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # create new user
        $this->createSuperUser();
    }

    /**
     * Create a single users with Super Admin access
     *
     * @return void
     */
    private function createSuperUser()
    {
        $now = now();
        $faker = Factory::create();

        $user = new User();
        $user->email = 'demo@todolist.com';
        $user->password = bcrypt('12341234');
        $user->first_name = $faker->firstName;
        $user->last_name = $faker->lastName;
        $user->created_at = $now;
        $user->updated_at = $now;

        $user->saveQuietly();
    }
}
