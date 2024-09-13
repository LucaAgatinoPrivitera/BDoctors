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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'message' => 'Salve, vorrei prenotare una visita per la prossima settimana.',
                'email' => 'bob.smith@example.com',
                'name' => 'Bob Smith',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 3,
                'message' => 'Posso avere più informazioni sulla terapia suggerita?',
                'email' => 'charlie.brown@example.com',
                'name' => 'Charlie Brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Grazie per la tua disponibilità. Quando posso venire?',
                'email' => 'david.wilson@example.com',
                'name' => 'David Wilson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'message' => 'Buonasera, ho dei dubbi sul trattamento prescritto.',
                'email' => 'eva.davis@example.com',
                'name' => 'Eva Davis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 3,
                'message' => 'Vorrei cambiare l’orario dell’appuntamento, è possibile?',
                'email' => 'frank.miller@example.com',
                'name' => 'Frank Miller',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Grazie mille per l’ottima consulenza!',
                'email' => 'grace.lee@example.com',
                'name' => 'Grace Lee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'message' => 'Ho bisogno di un certificato medico, puoi aiutarmi?',
                'email' => 'henry.moore@example.com',
                'name' => 'Henry Moore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 3,
                'message' => 'La visita di ieri è stata molto utile, grazie.',
                'email' => 'ivy.taylor@example.com',
                'name' => 'Ivy Taylor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Ho delle domande sulla prescrizione, puoi chiarirmi alcuni punti?',
                'email' => 'jack.anderson@example.com',
                'name' => 'Jack Anderson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'message' => 'Vorrei parlare dei risultati delle analisi.',
                'email' => 'karen.thomas@example.com',
                'name' => 'Karen Thomas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 3,
                'message' => 'Il mio bambino ha la febbre, cosa mi consigli?',
                'email' => 'liam.martinez@example.com',
                'name' => 'Liam Martinez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Grazie per aver risposto così velocemente!',
                'email' => 'mia.garcia@example.com',
                'name' => 'Mia Garcia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'message' => 'Posso avere una ricetta per il farmaco?',
                'email' => 'noah.rodriguez@example.com',
                'name' => 'Noah Rodriguez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 3,
                'message' => 'Quando potrei fare un’altra visita di controllo?',
                'email' => 'olivia.wilson@example.com',
                'name' => 'Olivia Wilson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 6 nuovi messaggi per doctor_id 1
            [
                'doctor_id' => 1,
                'message' => 'Mi è stata molto utile la tua consulenza, grazie ancora.',
                'email' => 'carl.murphy@example.com',
                'name' => 'Carl Murphy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Vorrei fissare un appuntamento per un controllo di routine.',
                'email' => 'danielle.foster@example.com',
                'name' => 'Danielle Foster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Ho delle domande riguardo alla mia ultima diagnosi.',
                'email' => 'emily.morris@example.com',
                'name' => 'Emily Morris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Potresti consigliarmi uno specialista per il mio problema?',
                'email' => 'frank.turner@example.com',
                'name' => 'Frank Turner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'La tua risposta è stata molto utile, grazie mille!',
                'email' => 'gina.williams@example.com',
                'name' => 'Gina Williams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'message' => 'Posso ricevere una copia dei risultati della mia ultima visita?',
                'email' => 'harry.jameson@example.com',
                'name' => 'Harry Jameson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
