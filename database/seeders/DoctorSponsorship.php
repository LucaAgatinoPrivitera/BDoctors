<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Sponsorship;
use Illuminate\Support\Carbon;

class DoctorSponsorshipSeeder extends Seeder
{
    public function run()
    {
        $doctors = Doctor::all();
        $sponsorships = Sponsorship::all();

        foreach ($doctors as $doctor) {
            foreach ($sponsorships as $sponsorship) {
                $startDate = Carbon::now();
                $endDate = $startDate->copy()->addDays((int) $sponsorship->duration);  // Conversione a intero

                $doctor->sponsorships()->attach($sponsorship->id, [
                    'name' => $sponsorship->name,
                    'price' => $sponsorship->price,
                    'date_start' => $startDate,
                    'date_end' => $endDate,
                ]);
            }
        }
    }
}