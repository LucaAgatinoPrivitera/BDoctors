<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    public function run()
    {
        $sponsorships = [
            ['name' => 'None', 'price' => 0, 'duration' => 300000],
            ['name' => 'Basic', 'price' => 29.99, 'duration' => 30],
            ['name' => 'Premium', 'price' => 49.99, 'duration' => 60],
            ['name' => 'Gold', 'price' => 79.99, 'duration' => 90],
        ];

        foreach ($sponsorships as $sponsorship) {
            Sponsorship::create($sponsorship);
        }
    }
}
