<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSpecialization extends Seeder
{
    public function run()
    {
        DB::table('doctor_specialization')->insert([
            ['doctor_id' => 1, 'specialization_id' => 1],
            ['doctor_id' => 1, 'specialization_id' => 2],
            ['doctor_id' => 2, 'specialization_id' => 1],
            
        ]);
    }
}
