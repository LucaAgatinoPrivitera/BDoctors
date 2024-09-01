<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            ['name' => 'Cardiologia'],
            ['name' => 'Dermatologia'],
            ['name' => 'Neurologia'],
            ['name' => 'Pediatria'],
            ['name' => 'Psichiatria'],
            ['name' => 'Oncologia'],
            ['name' => 'Oftalmologia'],
            ['name' => 'Ortopedia'],
            ['name' => 'Urologia'],
            ['name' => 'Ginecologia'],
        ];

        DB::table('specializations')->insert($specializations);
    }
}
