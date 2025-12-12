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
        $data = [
            [
                'name' => 'Perpustakaan',
                'slug' => 'perpustakaan',
                'description' => 'Perpustakaan menyediakan berbagai koleksi buku, jurnal ilmiah, karya penelitian, dan sumber digital yang dapat diakses oleh seluruh sivitas akademika. Fasilitas ini dirancang sebagai pusat informasi dan ruang belajar yang mendukung kegiatan akademik, mulai dari pencarian referensi hingga pendalaman materi perkuliahan. Selain area baca yang nyaman, perpustakaan juga dilengkapi layanan peminjaman, akses e-library, serta bimbingan penggunaan katalog sehingga pengguna dapat menemukan sumber pengetahuan dengan lebih mudah dan efisien.'
            ],
            [
                'name' => 'Kinerja Dosen',
                'slug' => 'kinerja-dosen',
                'description' => 'Layanan penilaian kinerja dosen berfungsi sebagai sarana untuk mengumpulkan umpan balik mahasiswa terkait kualitas pengajaran, metode penyampaian materi, kemampuan berkomunikasi, dan profesionalitas dosen dalam proses pembelajaran. Informasi ini digunakan untuk meningkatkan mutu pendidikan serta memastikan pengalaman belajar yang lebih efektif dan menyenangkan. Melalui layanan ini, mahasiswa dapat memberikan evaluasi secara objektif dan konstruktif sehingga kampus dapat melakukan pengembangan kualitas tenaga pendidik secara berkelanjutan.'
            ],
            [
                'name' => 'Ruang Kelas',
                'slug' => 'ruang-kelas',
                'description' => 'Fasilitas ruang kelas disiapkan untuk mendukung proses pembelajaran yang kondusif dengan tata ruang yang nyaman, perangkat pembelajaran yang memadai, serta suasana yang menunjang interaksi antara dosen dan mahasiswa. Setiap ruang dilengkapi fasilitas dasar seperti meja dan kursi ergonomis, papan tulis, proyektor, dan sistem ventilasi yang baik. Kualitas ruang kelas menjadi salah satu penentu kelancaran proses belajar, sehingga evaluasi terhadap kondisi dan kenyamanannya sangat penting untuk menjaga mutu pembelajaran.'
            ],
            [
                'name' => 'Laboratorium',
                'slug' => 'laboratorium',
                'description' => 'Laboratorium menyediakan ruang praktik bagi mahasiswa untuk melakukan eksperimen, penelitian, dan pengembangan keterampilan sesuai bidang ilmu masing-masing. Fasilitas ini dilengkapi peralatan penunjang praktik dan keselamatan kerja agar kegiatan dapat dilakukan dengan aman dan tepat. Laboratorium menjadi tempat mahasiswa menghubungkan teori dengan praktik sehingga pengalaman belajar menjadi lebih komprehensif. Pemeliharaan dan evaluasi terhadap laboratorium memastikan bahwa semua peralatan dan sarana berada dalam kondisi optimal untuk digunakan.'
            ],
            [
                'name' => 'Area Kampus',
                'slug' => 'area-kampus',
                'description' => 'Area kampus mencakup berbagai fasilitas penunjang aktivitas mahasiswa di luar ruang kelas, seperti taman, ruang terbuka, jalur pejalan kaki, area parkir, hingga fasilitas umum lainnya. Lingkungan kampus yang tertata rapi dan bersih memberikan kenyamanan dan keamanan bagi seluruh sivitas akademika. Evaluasi terhadap area kampus meliputi kebersihan, ketersediaan fasilitas umum, aksesibilitas, serta kenyamanan lingkungan. Fasilitas ini berperan penting dalam menciptakan suasana kampus yang mendukung kegiatan akademik maupun nonakademik.'
            ],
        ];

        Facility::insert($data);
    }
}
