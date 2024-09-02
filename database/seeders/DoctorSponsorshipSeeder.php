<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Sponsorship;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DoctorSponsorshipSeeder extends Seeder
{
    public function run()
    {
        $doctors = Doctor::all();
        $sponsorships = Sponsorship::all();

        foreach ($doctors as $doctor) {
            foreach ($sponsorships as $sponsorship) {
                // Assicurati che duration sia un intero
                $duration = (int) $sponsorship->duration;

                // Genera date di inizio e fine
                $startDate = Carbon::now()->startOfDay();
                $endDate = $startDate->copy()->addDays($duration);

                // Popola la tabella pivot senza colonne di timestamp
                DB::table('doctor_sponsorship')->insert([
                    'doctor_id' => $doctor->id,
                    'sponsorship_id' => $sponsorship->id,
                    'name' => $sponsorship->name,
                    'price' => $sponsorship->price,
                    'date_start' => $startDate,
                    'date_end' => $endDate,
                ]);
            }
        }
    }
}
