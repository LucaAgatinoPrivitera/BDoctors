<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('messages')->insert([
            [
                'doctor_id' => 1,
                'message' => 'Buongiorno, ho bisogno di una consulenza medica urgente.',
                'email' => 'alice.johnson@example.com',
                'name' => 'Alice Johnson',
            ],
            [
                'doctor_id' => 2,
                'message' => 'Salve, vorrei prenotare una visita per la prossima settimana.',
                'email' => 'bob.smith@example.com',
                'name' => 'Bob Smith',
            ],
            [
                'doctor_id' => 3,
                'message' => 'Posso avere più informazioni sulla terapia suggerita?',
                'email' => 'charlie.brown@example.com',
                'name' => 'Charlie Brown',
            ],
            [
                'doctor_id' => 1,
                'message' => 'Grazie per la tua disponibilità. Quando posso venire?',
                'email' => 'david.wilson@example.com',
                'name' => 'David Wilson',
            ],
            [
                'doctor_id' => 2,
                'message' => 'Buonasera, ho dei dubbi sul trattamento prescritto.',
                'email' => 'eva.davis@example.com',
                'name' => 'Eva Davis',
            ],
            [
                'doctor_id' => 3,
                'message' => 'Vorrei cambiare l’orario dell’appuntamento, è possibile?',
                'email' => 'frank.miller@example.com',
                'name' => 'Frank Miller',
            ],
            [
                'doctor_id' => 1,
                'message' => 'Grazie mille per l’ottima consulenza!',
                'email' => 'grace.lee@example.com',
                'name' => 'Grace Lee',
            ],
            [
                'doctor_id' => 2,
                'message' => 'Ho bisogno di un certificato medico, puoi aiutarmi?',
                'email' => 'henry.moore@example.com',
                'name' => 'Henry Moore',
            ],
            [
                'doctor_id' => 3,
                'message' => 'La visita di ieri è stata molto utile, grazie.',
                'email' => 'ivy.taylor@example.com',
                'name' => 'Ivy Taylor',
            ],
            [
                'doctor_id' => 1,
                'message' => 'Ho delle domande sulla prescrizione, puoi chiarirmi alcuni punti?',
                'email' => 'jack.anderson@example.com',
                'name' => 'Jack Anderson',
            ],
            [
                'doctor_id' => 2,
                'message' => 'Vorrei parlare dei risultati delle analisi.',
                'email' => 'karen.thomas@example.com',
                'name' => 'Karen Thomas',
            ],
            [
                'doctor_id' => 3,
                'message' => 'Il mio bambino ha la febbre, cosa mi consigli?',
                'email' => 'liam.martinez@example.com',
                'name' => 'Liam Martinez',
            ],
            [
                'doctor_id' => 1,
                'message' => 'Grazie per aver risposto così velocemente!',
                'email' => 'mia.garcia@example.com',
                'name' => 'Mia Garcia',
            ],
            [
                'doctor_id' => 2,
                'message' => 'Posso avere una ricetta per il farmaco?',
                'email' => 'noah.rodriguez@example.com',
                'name' => 'Noah Rodriguez',
            ],
            [
                'doctor_id' => 3,
                'message' => 'Quando potrei fare un’altra visita di controllo?',
                'email' => 'olivia.wilson@example.com',
                'name' => 'Olivia Wilson',
            ]
        ]);
    }
}
