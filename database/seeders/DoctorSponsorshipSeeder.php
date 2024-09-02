<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DoctorSponsorshipSeeder extends Seeder
{
    public function run()
    {
        $doctors = Doctor::all();
        $sponsorships = Sponsorship::all();

        foreach ($doctors as $doctor) {
            // Seleziona una sponsorizzazione casuale per il dottore
            $sponsorship = $sponsorships->random();

            // Calcola le date di inizio e fine
            $startDate = Carbon::now()->subDays(rand(1, 30)); // Data di inizio casuale negli ultimi 30 giorni
            $endDate = $startDate->copy()->addDays((int) $sponsorship->duration); // Conversione a int per evitare errori

            // Inserimento dati nella tabella pivot
            DB::table('doctor_sponsorship')->insert([
                'doctor_id' => $doctor->id,
                'sponsorship_id' => $sponsorship->id,
                'name' => $sponsorship->name,
                'price' => $sponsorship->price,
                'date_start' => $startDate->format('Y-m-d H:i:s'),
                'date_end' => $endDate->format('Y-m-d H:i:s'),
                'created_at' => now(), // Opzionale se non hai timestamps nella tabella pivot
                'updated_at' => now(), // Opzionale se non hai timestamps nella tabella pivot
            ]);
        }
    }
}
