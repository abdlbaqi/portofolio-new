<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Profil Pribadi
        DB::table('profil')->insert([
            'nama_lengkap' => 'Nama Anda',
            'panggilan' => 'Nama',
            'jabatan' => 'Full-Stack Web Developer & UI Designer',
            'slogan' => 'Membangun aplikasi web yang cepat, responsif, dan mudah digunakan.',
            'ringkasan_tentang' => 'Halo! Saya seorang Web Developer yang berdedikasi membangun aplikasi web modern dengan performa tinggi dan pengalaman pengguna yang luar biasa.',
            'deskripsi_lengkap' => 'Saya memiliki pengalaman dalam membangun berbagai sistem informasi, website perusahaan, dan aplikasi berbasis web. Menguasai ekosistem PHP/Laravel serta teknologi front-end modern.',
            'foto_profil' => 'profil/avatar.png',
            'file_cv' => 'dokumen/cv_nama_anda.pdf',
            'email' => 'kontak@domainanda.com',
            'no_telepon' => '+62 812-3456-7890',
            'alamat' => 'Jl. Merdeka No. 123',
            'kota' => 'Jakarta',
            'negara' => 'Indonesia',
            'status_pekerjaan' => 'Tersedia untuk Pekerjaan / Freelance',
            'tahun_pengalaman' => 3,
            'total_proyek_selesai' => 25,
            'total_klien_puas' => 18,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Media Sosial
        DB::table('media_sosial')->insert([
            ['nama_platform' => 'GitHub', 'url' => 'https://github.com/username', 'ikon' => 'github', 'urutan' => 1, 'apakah_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/username', 'ikon' => 'linkedin', 'urutan' => 2, 'apakah_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_platform' => 'Instagram', 'url' => 'https://instagram.com/username', 'ikon' => 'instagram', 'urutan' => 3, 'apakah_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Kategori Keahlian
        $frontendId = DB::table('kategori_keahlian')->insertGetId([
            'nama_kategori' => 'Front-End Development',
            'slug' => 'front-end-development',
            'urutan' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $backendId = DB::table('kategori_keahlian')->insertGetId([
            'nama_kategori' => 'Back-End Development',
            'slug' => 'back-end-development',
            'urutan' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $toolsId = DB::table('kategori_keahlian')->insertGetId([
            'nama_kategori' => 'Database & Tools',
            'slug' => 'database-and-tools',
            'urutan' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Keahlian
        DB::table('keahlian')->insert([
            ['kategori_id' => $frontendId, 'nama_keahlian' => 'HTML5 & CSS3', 'tingkat_persen' => 95, 'level' => 'Mahir', 'ikon' => 'html5', 'apakah_unggulan' => true, 'urutan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $frontendId, 'nama_keahlian' => 'Tailwind CSS', 'tingkat_persen' => 90, 'level' => 'Mahir', 'ikon' => 'tailwind', 'apakah_unggulan' => true, 'urutan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $frontendId, 'nama_keahlian' => 'JavaScript / Vue.js', 'tingkat_persen' => 85, 'level' => 'Menengah', 'ikon' => 'javascript', 'apakah_unggulan' => true, 'urutan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $backendId, 'nama_keahlian' => 'PHP & Laravel', 'tingkat_persen' => 90, 'level' => 'Mahir', 'ikon' => 'laravel', 'apakah_unggulan' => true, 'urutan' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $backendId, 'nama_keahlian' => 'RESTful API', 'tingkat_persen' => 88, 'level' => 'Mahir', 'ikon' => 'api', 'apakah_unggulan' => false, 'urutan' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $toolsId, 'nama_keahlian' => 'MySQL / PostgreSQL', 'tingkat_persen' => 85, 'level' => 'Mahir', 'ikon' => 'mysql', 'apakah_unggulan' => true, 'urutan' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['kategori_id' => $toolsId, 'nama_keahlian' => 'Git & GitHub', 'tingkat_persen' => 90, 'level' => 'Mahir', 'ikon' => 'git', 'apakah_unggulan' => false, 'urutan' => 7, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 5. Kategori Proyek
        $katWebId = DB::table('kategori_proyek')->insertGetId([
            'nama_kategori' => 'Aplikasi Web',
            'slug' => 'aplikasi-web',
            'deskripsi' => 'Proyek pengembangan sistem informasi dan aplikasi web interaktif.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 6. Proyek
        $proyekId = DB::table('proyek')->insertGetId([
            'kategori_id' => $katWebId,
            'judul' => 'Sistem Informasi Manajemen Inventaris',
            'slug' => 'sistem-informasi-manajemen-inventaris',
            'ringkasan' => 'Aplikasi web pencatatan stok barang, transaksi masuk-keluar, dan laporan inventaris otomatis.',
            'deskripsi' => 'Sistem ini dibuat untuk memudahkan pencatatan stok dan pelaporan inventaris gudang secara realtime dengan fitur role-based access control.',
            'gambar_sampul' => 'proyek/inventaris.jpg',
            'url_demo' => 'https://demo-inventaris.example.com',
            'url_repositori' => 'https://github.com/username/sistem-inventaris',
            'klien' => 'PT Contoh Solusi',
            'tanggal_selesai' => '2025-08-15',
            'teknologi' => json_encode(['Laravel', 'TailwindCSS', 'MySQL', 'Alpine.js']),
            'apakah_unggulan' => true,
            'status' => 'dipublikasi',
            'urutan' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 7. Pengalaman Kerja
        DB::table('pengalaman_kerja')->insert([
            [
                'posisi' => 'Full-Stack Developer',
                'perusahaan' => 'Tech Studio Indonesia',
                'tipe_pekerjaan' => 'Penuh Waktu',
                'lokasi' => 'Jakarta (Remote)',
                'tanggal_mulai' => '2024-01-01',
                'tanggal_selesai' => null,
                'saat_ini_bekerja' => true,
                'deskripsi' => 'Mengembangkan modul CMS, integrasi payment gateway, dan optimasi query database.',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 8. Pendidikan
        DB::table('pendidikan')->insert([
            [
                'nama_institusi' => 'Universitas Contoh Indonesia',
                'jurusan' => 'Teknik Informatika',
                'gelar' => 'Sarjana Komputer (S.Kom)',
                'nilai_akhir' => '3.80 / 4.00',
                'tanggal_mulai' => '2020-09-01',
                'tanggal_selesai' => '2024-07-20',
                'deskripsi' => 'Fokus pada rekayasa perangkat lunak dan arsitektur basis data.',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 9. Layanan
        DB::table('layanan')->insert([
            [
                'nama_layanan' => 'Pengembangan Website & Web App',
                'ikon' => 'code',
                'ringkasan' => 'Pembuatan website profesional, responsif, dan terintegrasi sistem backend yang aman.',
                'deskripsi' => 'Membangun website dari landing page hingga web aplikasi kustom menggunakan Laravel & Tailwind CSS.',
                'harga_mulai_dari' => 2500000,
                'apakah_aktif' => true,
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 10. Pengaturan Situs
        DB::table('pengaturan_situs')->insert([
            ['kunci' => 'judul_situs', 'nilai' => 'Portofolio Profesional', 'tipe' => 'teks', 'grup' => 'umum', 'keterangan' => 'Judul halaman website', 'created_at' => now(), 'updated_at' => now()],
            ['kunci' => 'deskripsi_situs', 'nilai' => 'Portofolio web developer profesional', 'tipe' => 'textarea', 'grup' => 'seo', 'keterangan' => 'Meta deskripsi SEO', 'created_at' => now(), 'updated_at' => now()],
            ['kunci' => 'teks_footer', 'nilai' => '© 2026 Hak Cipta Dilindungi.', 'tipe' => 'teks', 'grup' => 'umum', 'keterangan' => 'Teks di bagian footer', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
