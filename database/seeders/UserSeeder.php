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
                'name' => 'Alice',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Bob',
                'email' => 'bob.smith@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Charlie',
                'email' => 'charlie.brown@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'David',
                'email' => 'david.wilson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Eva',
                'email' => 'eva.davis@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Frank',
                'email' => 'frank.miller@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Grace',
                'email' => 'grace.lee@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Henry',
                'email' => 'henry.moore@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Ivy',
                'email' => 'ivy.taylor@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jack',
                'email' => 'jack.anderson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Karen',
                'email' => 'karen.thomas@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Liam',
                'email' => 'liam.martinez@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Mia',
                'email' => 'mia.garcia@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Noah',
                'email' => 'noah.rodriguez@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Olivia',
                'email' => 'olivia.wilson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ],
        ]);
    }
}
