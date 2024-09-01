<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class doctor_specialization extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorSpecializations = [
            ['doctor_id' => 1, 'specialization_id' => 1], // Collegamento tra medico con ID 1 e specializzazione 1
            ['doctor_id' => 1, 'specialization_id' => 2], // Collegamento tra medico con ID 1 e specializzazione 2
            ['doctor_id' => 2, 'specialization_id' => 3], // Collegamento tra medico con ID 2 e specializzazione 3
            ['doctor_id' => 2, 'specialization_id' => 4], // Collegamento tra medico con ID 2 e specializzazione 4
            // Aggiungi ulteriori associazioni qui secondo le tue necessità
        ];

        DB::table('doctor_specialization')->insert($doctorSpecializations);
    }
}
