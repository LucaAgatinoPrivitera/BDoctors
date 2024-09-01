<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Doctor;

class ReviewSeeder extends Seeder
{
    
    public function run(): void
    {
        // Recupera i primi 15 dottori
        $doctors = Doctor::take(15)->get();

        // Verifica che ci siano medici disponibili
        if ($doctors->isEmpty()) {
            $this->command->info('No doctors found, skipping reviews seeding.');
            return;
        }

        // Dati di esempio per le recensioni
        $reviews = [
            [
                'stars' => 5,
                'review_text' => 'Ottimo medico, molto professionale e gentile.',
                'name_reviewer' => 'Mario Rossi',
                'email_reviewer' => 'mario.rossi@example.com',
            ],
            [
                'stars' => 4,
                'review_text' => 'Buon dottore, ma un po\' difficile da raggiungere.',
                'name_reviewer' => 'Luca Bianchi',
                'email_reviewer' => 'luca.bianchi@example.com',
            ],
            [
                'stars' => 3,
                'review_text' => 'Il medico è bravo, ma l\'attesa è stata lunga.',
                'name_reviewer' => 'Giulia Verdi',
                'email_reviewer' => 'giulia.verdi@example.com',
            ],
            [
                'stars' => 5,
                'review_text' => 'Esperienza eccellente, tornerò sicuramente.',
                'name_reviewer' => 'Francesco Neri',
                'email_reviewer' => 'francesco.neri@example.com',
            ],
            [
                'stars' => 4,
                'review_text' => 'Molto preparato e disponibile.',
                'name_reviewer' => 'Elena Blu',
                'email_reviewer' => 'elena.blu@example.com',
            ],
            [
                'stars' => 2,
                'review_text' => 'Il dottore è bravo, ma lo studio non era molto pulito.',
                'name_reviewer' => 'Alessandro Gialli',
                'email_reviewer' => 'alessandro.gialli@example.com',
            ],
            [
                'stars' => 5,
                'review_text' => 'Medico eccezionale, molto cortese e professionale.',
                'name_reviewer' => 'Sofia Rosa',
                'email_reviewer' => 'sofia.rosa@example.com',
            ],
            [
                'stars' => 3,
                'review_text' => 'Non mi ha convinto completamente, ma è competente.',
                'name_reviewer' => 'Matteo Viola',
                'email_reviewer' => 'matteo.viola@example.com',
            ],
            [
                'stars' => 4,
                'review_text' => 'Buona esperienza, lo consiglio.',
                'name_reviewer' => 'Valeria Verde',
                'email_reviewer' => 'valeria.verde@example.com',
            ],
            [
                'stars' => 5,
                'review_text' => 'Molto preparato e sempre disponibile.',
                'name_reviewer' => 'Giorgio Neri',
                'email_reviewer' => 'giorgio.neri@example.com',
            ],
            [
                'stars' => 4,
                'review_text' => 'Dottore professionale e attento.',
                'name_reviewer' => 'Martina Bianchi',
                'email_reviewer' => 'martina.bianchi@example.com',
            ],
            [
                'stars' => 2,
                'review_text' => 'L\'esperienza non è stata delle migliori.',
                'name_reviewer' => 'Federico Rossi',
                'email_reviewer' => 'federico.rossi@example.com',
            ],
            [
                'stars' => 5,
                'review_text' => 'Eccellente, molto consigliato!',
                'name_reviewer' => 'Chiara Blu',
                'email_reviewer' => 'chiara.blu@example.com',
            ],
            [
                'stars' => 3,
                'review_text' => 'Niente di eccezionale, ma sufficiente.',
                'name_reviewer' => 'Simone Verdi',
                'email_reviewer' => 'simone.verdi@example.com',
            ],
            [
                'stars' => 4,
                'review_text' => 'Professionale e cortese.',
                'name_reviewer' => 'Serena Gialli',
                'email_reviewer' => 'serena.gialli@example.com',
            ]
        ];

        // Associa ogni recensione ad un medico
        foreach ($doctors as $index => $doctor) {
            Review::create(array_merge($reviews[$index], ['doctor_id' => $doctor->id]));
        }
    }
}
