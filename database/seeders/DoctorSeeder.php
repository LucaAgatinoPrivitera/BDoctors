<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        // Ottieni tutti gli ID degli utenti e i loro nomi
        $users = DB::table('users')->get(['id', 'name']);
        $userIds = $users->pluck('id');
        $userNames = $users->pluck('name', 'id');

        DB::table('doctors')->insert([
            [
                'user_id' => $userIds->random(),
                'surname' => $surname = 'Rossi',
                'address' => 'Via Roma, 1',
                'cv' => 'path/to/cv1.pdf',
                'pic' => 'path/to/pic1.jpg',
                'phone' => '0123456789',
                'bio' => 'Medico esperto in cardiologia.',
                'slug' => $userNames->random() . '-' . $surname,
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Verdi',
                'address' => 'Via Milano, 2',
                'cv' => 'path/to/cv2.pdf',
                'pic' => 'path/to/pic2.jpg',
                'phone' => '0123456788',
                'bio' => 'Medico esperto in neurologia.',
                'slug' => $userNames->random() . '-' . 'Verdi',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Bianchi',
                'address' => 'Via Firenze, 3',
                'cv' => 'path/to/cv3.pdf',
                'pic' => 'path/to/pic3.jpg',
                'phone' => '0123456787',
                'bio' => 'Medico esperto in pediatria.',
                'slug' => $userNames->random() . '-' . 'Bianchi',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Neri',
                'address' => 'Via Napoli, 4',
                'cv' => 'path/to/cv4.pdf',
                'pic' => 'path/to/pic4.jpg',
                'phone' => '0123456786',
                'bio' => 'Medico esperto in dermatologia.',
                'slug' => $userNames->random() . '-' . 'Neri',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Gialli',
                'address' => 'Via Torino, 5',
                'cv' => 'path/to/cv5.pdf',
                'pic' => 'path/to/pic5.jpg',
                'phone' => '0123456785',
                'bio' => 'Medico esperto in ortopedia.',
                'slug' => $userNames->random() . '-' . 'Gialli',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Marroni',
                'address' => 'Via Bologna, 6',
                'cv' => 'path/to/cv6.pdf',
                'pic' => 'path/to/pic6.jpg',
                'phone' => '0123456784',
                'bio' => 'Medico esperto in oncologia.',
                'slug' => $userNames->random() . '-' . 'Marroni',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Rosa',
                'address' => 'Via Venezia, 7',
                'cv' => 'path/to/cv7.pdf',
                'pic' => 'path/to/pic7.jpg',
                'phone' => '0123456783',
                'bio' => 'Medico esperto in ginecologia.',
                'slug' => $userNames->random() . '-' . 'Rosa',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Azzurri',
                'address' => 'Via Genova, 8',
                'cv' => 'path/to/cv8.pdf',
                'pic' => 'path/to/pic8.jpg',
                'phone' => '0123456782',
                'bio' => 'Medico esperto in cardiologia pediatrica.',
                'slug' => $userNames->random() . '-' . 'Azzurri',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Biondi',
                'address' => 'Via Palermo, 9',
                'cv' => 'path/to/cv9.pdf',
                'pic' => 'path/to/pic9.jpg',
                'phone' => '0123456781',
                'bio' => 'Medico esperto in neurochirurgia.',
                'slug' => $userNames->random() . '-' . 'Biondi',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Castagna',
                'address' => 'Via Bari, 10',
                'cv' => 'path/to/cv10.pdf',
                'pic' => 'path/to/pic10.jpg',
                'phone' => '0123456780',
                'bio' => 'Medico esperto in reumatologia.',
                'slug' => $userNames->random() . '-' . 'Castagna',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Cappelli',
                'address' => 'Via Pisa, 11',
                'cv' => 'path/to/cv11.pdf',
                'pic' => 'path/to/pic11.jpg',
                'phone' => '0123456779',
                'bio' => 'Medico esperto in medicina generale.',
                'slug' => $userNames->random() . '-' . 'Cappelli',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Oliva',
                'address' => 'Via Cagliari, 12',
                'cv' => 'path/to/cv12.pdf',
                'pic' => 'path/to/pic12.jpg',
                'phone' => '0123456778',
                'bio' => 'Medico esperto in endocrinologia.',
                'slug' => $userNames->random() . '-' . 'Oliva',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Ponte',
                'address' => 'Via Ancona, 13',
                'cv' => 'path/to/cv13.pdf',
                'pic' => 'path/to/pic13.jpg',
                'phone' => '0123456777',
                'bio' => 'Medico esperto in urologia.',
                'slug' => $userNames->random() . '-' . 'Ponte',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Ferrari',
                'address' => 'Via Perugia, 14',
                'cv' => 'path/to/cv14.pdf',
                'pic' => 'path/to/pic14.jpg',
                'phone' => '0123456776',
                'bio' => 'Medico esperto in medicina sportiva.',
                'slug' => $userNames->random() . '-' . 'Ferrari',
            ],
            [
                'user_id' => $userIds->random(),
                'surname' => 'Lombardi',
                'address' => 'Via Salerno, 15',
                'cv' => 'path/to/cv15.pdf',
                'pic' => 'path/to/pic15.jpg',
                'phone' => '0123456775',
                'bio' => 'Medico esperto in psichiatria.',
                'slug' => $userNames->random() . '-' . 'Lombardi',
            ],
        ]);
    }
}
