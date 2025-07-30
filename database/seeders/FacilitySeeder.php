<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Perpustakaan',
                'slug' => 'perpustakaan',
                'description' => 'Perpustakaan UTM merupakan pusat referensi dan literasi akademik yang terus berkembang seiring dengan kebutuhan zaman. Koleksinya mencakup ribuan buku cetak, e-book, jurnal nasional dan internasional, serta berbagai skripsi dan laporan penelitian mahasiswa. Ruang baca didesain nyaman dan tenang, dilengkapi dengan area diskusi kelompok dan akses komputer. Layanan digital perpustakaan juga memungkinkan mahasiswa mengakses sumber belajar secara daring, menjadikan perpustakaan sebagai penunjang utama proses belajar mengajar di era digital.'
            ],
            [
                'name' => 'Kinerja Dosen',
                'slug' => 'kinerja-dosen',
                'description' => 'Dosen di Universitas Teknologi Mataram dikenal memiliki dedikasi tinggi dalam menjalankan tugas akademik. Mereka tidak hanya menguasai materi perkuliahan secara mendalam, tetapi juga mampu menyampaikannya dengan metode yang interaktif dan mudah dipahami mahasiswa. Kehadiran dosen di setiap perkuliahan sangat konsisten, didukung dengan persiapan materi yang matang serta penggunaan teknologi pembelajaran yang relevan. Selain itu, dosen juga aktif dalam membimbing tugas akhir, penelitian mahasiswa, dan terbuka terhadap diskusi di luar jam kuliah, menciptakan hubungan akademik yang suportif dan membangun.'
            ],
            [
                'name' => 'Ruang Kelas',
                'slug' => 'ruang-kelas',
                'description' => 'Ruang kelas di Universitas Teknologi Mataram dirancang modern dan ergonomis untuk mendukung kenyamanan dan efektivitas pembelajaran. Setiap kelas dilengkapi dengan pendingin ruangan (AC), proyektor, whiteboard, serta jaringan internet yang stabil. Tata letak kursi dan meja disesuaikan agar menciptakan suasana belajar yang kondusif dan tidak membosankan. Kebersihan dan pencahayaan ruang juga sangat diperhatikan, menjadikan ruang kelas sebagai tempat belajar yang nyaman dan profesional.'
            ],
            [
                'name' => 'Laboratorium',
                'slug' => 'laboratorium',
                'description' => 'Fasilitas laboratorium di Universitas Teknologi Mataram sangat memadai untuk kegiatan praktikum dan riset mahasiswa. Setiap laboratorium dilengkapi dengan peralatan sesuai standar industri dan kebutuhan program studi masing-masing, mulai dari laboratorium komputer, teknik, hingga laboratorium sains. Pengelolaan laboratorium dilakukan oleh teknisi berpengalaman, serta didukung protokol keselamatan yang ketat. Laboratorium ini juga menjadi ruang inovasi dan eksplorasi, mendorong mahasiswa untuk aktif melakukan eksperimen dan pengembangan teknologi.'
            ],
            [
                'name' => 'Lingkungan Kampus',
                'slug' => 'lingkungan-kampus',
                'description' => 'Lingkungan kampus Universitas Teknologi Mataram memiliki atmosfer yang asri, hijau, dan tertata rapi. Area kampus dipenuhi taman-taman kecil, jalur pedestrian yang nyaman, dan fasilitas umum yang ramah mahasiswa. Kebersihan lingkungan selalu dijaga, serta tersedia berbagai ruang terbuka sebagai tempat istirahat, diskusi, atau sekadar melepas penat. Suasana kampus yang aman dan inklusif menciptakan pengalaman kuliah yang menyenangkan, mendukung pengembangan karakter, kreativitas, dan kolaborasi antar mahasiswa.'
            ],
            [
                'name' => 'Kualitas Internet',
                'slug' => 'kualitas-internet',
                'description' => 'Universitas Teknologi Mataram menyediakan jaringan internet yang cepat, stabil, dan dapat diakses di seluruh area kampus. Mahasiswa dan dosen dapat terhubung dengan mudah melalui Wi-Fi yang aman dan mendukung berbagai aktivitas akademik seperti e-learning, riset daring, dan konferensi virtual. Ketersediaan internet yang andal menjadi penunjang utama dalam proses pembelajaran berbasis digital di UTM.'
            ],
        ];

        Facility::insert($facilities);
    }
}
