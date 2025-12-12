<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Library
            [
                'facility_id' => 1,
                'content' => 'Perpustakaan memiliki koleksi buku dan jurnal yang lengkap dan relevan.'
            ],
            [
                'facility_id' => 1,
                'content' => 'Perpustakaan memiliki ruangan yang bersih, nyaman, dan dilengkapi fasilitas modern (ac, pencahayaan, tempat duduk).'
            ],
            [
                'facility_id' => 1,
                'content' => 'Sistem peminjaman dan pengembalian buku berjalan dengan lancar dan tepat waktu.'
            ],
            [
                'facility_id' => 1,
                'content' => 'Petugas perpustakaan responsif dan cepat dalam membantu mahasiswa mencari referensi'
            ],
            [
                'facility_id' => 1,
                'content' => 'Petugas perpustakaan melayani dengan ramah dan memahami kebutuhan mahasiswa.'
            ],

            // Lecture Quality
            [
                'facility_id' => 2,
                'content' => 'Dosen menyediakan bahan ajar (modul, slide, materi) yang lengkap dan berkualitas.'
            ],
            [
                'facility_id' => 2,
                'content' => 'Dosen hadir tepat waktu dan menyelesaikan materi sesuai dengan rencana pembelajaran.'
            ],
            [
                'facility_id' => 2,
                'content' => 'Dosen memiliki kompetensi dan mampu menjelaskan materi dengan jelas dan mudah dipahami.'
            ],
            [
                'facility_id' => 2,
                'content' => 'Dosen responsif dalam menjawab pertanyaan dan mudah dihubungi untuk konsultasi.'
            ],
            [
                'facility_id' => 2,
                'content' => 'Dosen menunjukkan perhatian personal terhadap perkembangan belajar mahasiswa.'
            ],

            // Class Room
            [
                'facility_id' => 3,
                'content' => 'Ruang kelas memiliki fasilitas yang lengkap dan modern (proyektor, ac, whiteboard, sound system).'
            ],
            [
                'facility_id' => 3,
                'content' => 'Ruang kelas bersih, nyaman, dan memiliki pencahayaan serta ventilasi yang baik.'
            ],
            [
                'facility_id' => 3,
                'content' => 'Kapasitas dan tata letak tempat duduk di ruang kelas memadai dan nyaman.'
            ],
            [
                'facility_id' => 3,
                'content' => 'Fasilitas di ruang kelas (proyektor, ac, sound system) selalu berfungsi dengan baik.'
            ],
            [
                'facility_id' => 3,
                'content' => 'Keluhan terkait kerusakan fasilitas ruang kelas ditanggapi dan diperbaiki dengan cepat.'
            ],

            // Lab
            [
                'facility_id' => 4,
                'content' => 'Laboratorium dilengkapi dengan peralatan dan komputer yang memadai dan up-to-date.'
            ],
            [
                'facility_id' => 4,
                'content' => 'Laboratorium memiliki ruangan yang bersih, nyaman, dan dilengkapi fasilitas pendukung (ac, pencahayaan).'
            ],
            [
                'facility_id' => 4,
                'content' => 'Peralatan dan komputer di laboratorium selalu dalam kondisi baik dan siap digunakan.'
            ],
            [
                'facility_id' => 4,
                'content' => 'Asisten/teknisi laboratorium responsif dalam membantu mahasiswa yang mengalami kesulitan.'
            ],
            [
                'facility_id' => 4,
                'content' => 'Laboratorium memberikan jaminan keamanan dan kenyamanan selama praktikum.'
            ],

            // Park Yard
            [
                'facility_id' => 5,
                'content' => 'Area kampus bersih, hijau, dan terawat dengan baik.'
            ],
            [
                'facility_id' => 5,
                'content' => 'Fasilitas pendukung kampus (kantin, toilet, mushola, tempat parkir) dalam kondisi baik dan memadai.'
            ],
            [
                'facility_id' => 5,
                'content' => 'Lingkungan kampus tertata rapi dengan signage/petunjuk arah yang jelas.'
            ],
            [
                'facility_id' => 5,
                'content' => 'Lingkungan kampus aman, nyaman, dan kondusif untuk kegiatan akademik.'
            ],
            [
                'facility_id' => 5,
                'content' => 'Kampus menyediakan area/ruang publik yang nyaman untuk mahasiswa berdiskusi dan bersosialisasi.'
            ],
        ];

        Question::insert($data);
    }
}
