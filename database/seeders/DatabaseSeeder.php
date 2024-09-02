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
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(DoctorSpecialization::class);
        $this->call(MessagesSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(SponsorshipSeeder::class);
        $this->call(DoctorSponsorshipSeeder::class);
        
        
    }
}
