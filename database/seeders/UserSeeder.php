<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob.smith@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Charlie Brown',
                'email' => 'charlie.brown@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Eva Davis',
                'email' => 'eva.davis@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Frank Miller',
                'email' => 'frank.miller@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Grace Lee',
                'email' => 'grace.lee@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Henry Moore',
                'email' => 'henry.moore@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Ivy Taylor',
                'email' => 'ivy.taylor@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jack Anderson',
                'email' => 'jack.anderson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Karen Thomas',
                'email' => 'karen.thomas@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Liam Martinez',
                'email' => 'liam.martinez@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Mia Garcia',
                'email' => 'mia.garcia@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Noah Rodriguez',
                'email' => 'noah.rodriguez@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Olivia Wilson',
                'email' => 'olivia.wilson@example.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}

