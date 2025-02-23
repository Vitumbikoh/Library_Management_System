<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create 10 regular users
        User::factory(10)->create();

        // Create 2 admin users
        User::factory()->admin()->count(2)->create();
    }
}

