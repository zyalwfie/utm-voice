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
        $questions = [
            'kinerja-dosen' => [
                'Kesiapan dosen dalam memberikan materi perkuliahan.',
                'Kemampuan dosen dalam menjelaskan materi perkuliahan.',
                'Interaksi dan komunikasi dosen dengan mahasiswa.',
                'Ketepatan waktu dosen dalam memulai dan mengakhiri kuliah.',
                'Penguasaan dosen terhadap materi ajar.',
                'Kemampuan dosen dalam menjawab pertanyaan mahasiswa.',
                'Pemberian tugas dan relevansinya terhadap materi.',
                'Penilaian dosen terhadap tugas dan ujian secara objektif.',
                'Dosen memberikan motivasi dalam proses pembelajaran.',
                'Kesesuaian metode mengajar dosen dengan mata kuliah.',
            ],
            'perpustakaan' => [
                'Ketersediaan koleksi buku yang sesuai dengan kebutuhan perkuliahan.',
                'Kemudahan dalam mencari dan meminjam buku.',
                'Ketersediaan literatur digital dan akses jurnal online.',
                'Kebersihan dan kenyamanan ruang perpustakaan.',
                'Kecepatan pelayanan staf perpustakaan.',
                'Ketersediaan tempat belajar di perpustakaan.',
                'Jam operasional perpustakaan sesuai kebutuhan mahasiswa.',
                'Ketersediaan komputer atau fasilitas teknologi informasi.',
                'Ketertiban dan suasana kondusif untuk belajar.',
                'Ketersediaan layanan bimbingan atau informasi oleh pustakawan.',
            ],
            'ruang-kelas' => [
                'Kebersihan ruang kelas secara keseluruhan.',
                'Ketersediaan dan kenyamanan kursi dan meja.',
                'Pencahayaan ruang kelas yang memadai.',
                'Sirkulasi udara atau pendingin ruangan yang baik.',
                'Ketersediaan perangkat pembelajaran (proyektor, whiteboard, dll).',
                'Tingkat kebisingan di dalam ruang kelas saat perkuliahan.',
                'Aksesibilitas ruang kelas (tangga, lift, petunjuk arah, dll).',
                'Keamanan ruang kelas dari gangguan luar.',
                'Ketersediaan colokan listrik bagi mahasiswa (jika diperlukan).',
                'Kesesuaian kapasitas ruang kelas dengan jumlah mahasiswa.',
            ],
            'laboratorium' => [
                'Ketersediaan alat dan bahan praktik yang memadai.',
                'Kondisi dan kelayakan peralatan laboratorium.',
                'Kebersihan dan keamanan ruang laboratorium.',
                'Ketersediaan petugas/laboran saat praktik.',
                'Bimbingan dosen/instruktur selama kegiatan praktik.',
                'Kejelasan prosedur kerja dan keselamatan laboratorium.',
                'Jadwal penggunaan laboratorium yang tertata.',
                'Efektivitas kegiatan praktik dalam mendukung pemahaman materi.',
                'Fasilitas penunjang lain seperti komputer, software, dsb.',
                'Prosedur peminjaman atau penggunaan alat laboratorium.',
            ],
            'lingkungan-kampus' => [
                'Kebersihan lingkungan kampus secara keseluruhan.',
                'Ketersediaan ruang terbuka untuk belajar, diskusi, atau bersantai.',
                'Tata letak fasilitas kampus memudahkan mobilitas antar gedung.',
                'Keamanan lingkungan kampus saat aktivitas perkuliahan maupun di luar jam kuliah.',
                'Ketersediaan tempat parkir untuk mahasiswa dan staf.',
                'Tersedianya area ramah difabel (ramp, toilet khusus, dll).',
                'Ketersediaan fasilitas umum seperti kantin, musala, dan toilet yang memadai.',
                'Tingkat kenyamanan suasana kampus untuk belajar dan beraktivitas.',
                'Tingkat kebisingan di area sekitar kampus tidak mengganggu proses belajar.',
                'Estetika dan keasrian kampus (taman, pepohonan, mural, dll).',
            ],
            'kualitas-internet' => [
                'Ketersediaan jaringan Wi-Fi di seluruh area kampus.',
                'Kemudahan mahasiswa dalam mengakses jaringan internet kampus.',
                'Stabilitas koneksi internet selama penggunaan.',
                'Kecepatan internet dalam mengakses materi kuliah, video, atau platform e-learning.',
                'Kemampuan internet mendukung perkuliahan online atau hybrid.',
                'Ketersediaan bantuan teknis ketika terjadi masalah koneksi.',
                'Keamanan jaringan Wi-Fi kampus (login user, perlindungan data, dll).',
                'Tersedianya hotspot atau titik akses Wi-Fi di area publik (perpustakaan, taman, dll).',
                'Kemudahan akses ke sumber referensi akademik daring (jurnal, e-book, dll).',
                'Kualitas internet mendukung aktivitas belajar mandiri mahasiswa di kampus.',
            ],
        ];

        foreach ($questions as $slug => $items) {
            $facility = Facility::where('slug', $slug)->first();

            if ($facility) {
                foreach ($items as $text) {
                    Question::create([
                        'facility_id' => $facility->id,
                        'content' => $text,
                    ]);
                }
            }
        }
    }
}
