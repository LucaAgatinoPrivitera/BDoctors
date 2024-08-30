<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('doctor')->insert([
            [
                'surname' => 'Rossi',
                'address' => 'Via Roma, 1',
                'cv' => 'path/to/cv1.pdf',
                'pic' => 'path/to/pic1.jpg',
                'phone' => '0123456789',
                'bio' => 'Medico esperto in cardiologia.',
            ],
            [
                'surname' => 'Verdi',
                'address' => 'Via Milano, 2',
                'cv' => 'path/to/cv2.pdf',
                'pic' => 'path/to/pic2.jpg',
                'phone' => '0123456788',
                'bio' => 'Medico esperto in neurologia.',
            ],
            [
                'surname' => 'Bianchi',
                'address' => 'Via Firenze, 3',
                'cv' => 'path/to/cv3.pdf',
                'pic' => 'path/to/pic3.jpg',
                'phone' => '0123456787',
                'bio' => 'Medico esperto in pediatria.',
            ],
            [
                'surname' => 'Neri',
                'address' => 'Via Napoli, 4',
                'cv' => 'path/to/cv4.pdf',
                'pic' => 'path/to/pic4.jpg',
                'phone' => '0123456786',
                'bio' => 'Medico esperto in dermatologia.',
            ],
            [
                'surname' => 'Gialli',
                'address' => 'Via Torino, 5',
                'cv' => 'path/to/cv5.pdf',
                'pic' => 'path/to/pic5.jpg',
                'phone' => '0123456785',
                'bio' => 'Medico esperto in ortopedia.',
            ],
            [
                'surname' => 'Marroni',
                'address' => 'Via Bologna, 6',
                'cv' => 'path/to/cv6.pdf',
                'pic' => 'path/to/pic6.jpg',
                'phone' => '0123456784',
                'bio' => 'Medico esperto in oncologia.',
            ],
            [
                'surname' => 'Rosa',
                'address' => 'Via Venezia, 7',
                'cv' => 'path/to/cv7.pdf',
                'pic' => 'path/to/pic7.jpg',
                'phone' => '0123456783',
                'bio' => 'Medico esperto in ginecologia.',
            ],
            [
                'surname' => 'Azzurri',
                'address' => 'Via Genova, 8',
                'cv' => 'path/to/cv8.pdf',
                'pic' => 'path/to/pic8.jpg',
                'phone' => '0123456782',
                'bio' => 'Medico esperto in cardiologia pediatrica.',
            ],
            [
                'surname' => 'Biondi',
                'address' => 'Via Palermo, 9',
                'cv' => 'path/to/cv9.pdf',
                'pic' => 'path/to/pic9.jpg',
                'phone' => '0123456781',
                'bio' => 'Medico esperto in neurochirurgia.',
            ],
            [
                'surname' => 'Castagna',
                'address' => 'Via Bari, 10',
                'cv' => 'path/to/cv10.pdf',
                'pic' => 'path/to/pic10.jpg',
                'phone' => '0123456780',
                'bio' => 'Medico esperto in reumatologia.',
            ],
            [
                'surname' => 'Cappelli',
                'address' => 'Via Pisa, 11',
                'cv' => 'path/to/cv11.pdf',
                'pic' => 'path/to/pic11.jpg',
                'phone' => '0123456779',
                'bio' => 'Medico esperto in medicina generale.',
            ],
            [
                'surname' => 'Oliva',
                'address' => 'Via Cagliari, 12',
                'cv' => 'path/to/cv12.pdf',
                'pic' => 'path/to/pic12.jpg',
                'phone' => '0123456778',
                'bio' => 'Medico esperto in endocrinologia.',
            ],
            [
                'surname' => 'Ponte',
                'address' => 'Via Ancona, 13',
                'cv' => 'path/to/cv13.pdf',
                'pic' => 'path/to/pic13.jpg',
                'phone' => '0123456777',
                'bio' => 'Medico esperto in urologia.',
            ],
            [
                'surname' => 'Ferrari',
                'address' => 'Via Perugia, 14',
                'cv' => 'path/to/cv14.pdf',
                'pic' => 'path/to/pic14.jpg',
                'phone' => '0123456776',
                'bio' => 'Medico esperto in medicina sportiva.',
            ],
            [
                'surname' => 'Lombardi',
                'address' => 'Via Salerno, 15',
                'cv' => 'path/to/cv15.pdf',
                'pic' => 'path/to/pic15.jpg',
                'phone' => '0123456775',
                'bio' => 'Medico esperto in psichiatria.',
            ],
        ]);
    }
}
