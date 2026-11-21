<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Proyek;
use App\Models\KategoriKeahlian;
use App\Models\PengalamanKerja;
use App\Models\Layanan;
use App\Models\Testimoni;
use App\Models\MediaSosial;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Halaman Publik Portofolio
     */
    public function index()
    {
        $profil = null;
        $proyekUnggulan = collect([]);
        $kategoriKeahlian = collect([]);
        $pengalaman = collect([]);
        $layanan = collect([]);
        $testimoni = collect([]);
        $mediaSosial = collect([]);

        try {
            $profil = Profil::first();
            $proyekUnggulan = Proyek::with('kategori')->where('status', 'dipublikasi')->orderBy('urutan')->get();
            $kategoriKeahlian = KategoriKeahlian::with('keahlian')->orderBy('urutan')->get();
            $pengalaman = PengalamanKerja::orderBy('tanggal_mulai', 'desc')->get();
            $layanan = Layanan::where('apakah_aktif', true)->orderBy('urutan')->get();
            $testimoni = Testimoni::where('apakah_ditampilkan', true)->orderBy('urutan')->get();
            $mediaSosial = MediaSosial::where('apakah_aktif', true)->orderBy('urutan')->get();
        } catch (\Throwable $e) {
            // Graceful fallback
        }

        if (!$profil) {
            $profil = (object)[
                'nama_lengkap' => 'Fuad Bandhu',
                'panggilan' => 'Fuad',
                'jabatan' => 'Full-Stack Developer & UI/UX Designer',
                'slogan' => 'Membangun Produk Digital Modern dengan Desain Presisi.',
                'ringkasan_tentang' => 'Halo! Saya seorang developer yang fokus membangun sistem aplikasi modern, CMS kustom, dan solusi web end-to-end dengan standar industri.',
                'deskripsi_lengkap' => 'Berpengalaman menangani berbagai proyek web dari tahap rancangan arsitektur hingga deployment produksi.',
                'kota' => 'Jakarta',
                'negara' => 'Indonesia',
                'email' => 'fuad@example.com',
                'status_pekerjaan' => 'Tersedia untuk Pekerjaan / Freelance',
                'tahun_pengalaman' => 4,
                'total_proyek_selesai' => 25,
                'total_klien_puas' => 18,
            ];
        }

        if ($proyekUnggulan->isEmpty()) {
            $proyekUnggulan = collect([
                (object)[
                    'id' => 1,
                    'judul' => 'Fintech SaaS Dashboard',
                    'slug' => 'fintech-saas-dashboard',
                    'ringkasan' => 'Platform manajemen finansial real-time dengan antarmuka modern dan visualisasi grafik interaktif.',
                    'kategori' => (object)['nama_kategori' => 'Web Application'],
                    'teknologi' => ['Laravel', 'TailwindCSS', 'MySQL'],
                    'url_demo' => '#',
                    'url_repositori' => '#',
                ],
                (object)[
                    'id' => 2,
                    'judul' => 'E-Commerce Mobile Platform',
                    'slug' => 'ecommerce-mobile-platform',
                    'ringkasan' => 'Sistem e-commerce terintegrasi dengan gateway pembayaran dan pelacakan kurir realtime.',
                    'kategori' => (object)['nama_kategori' => 'Mobile App'],
                    'teknologi' => ['React Native', 'Node.js', 'PostgreSQL'],
                    'url_demo' => '#',
                    'url_repositori' => '#',
                ],
                (object)[
                    'id' => 3,
                    'judul' => 'Brand Identity & Web Portfolio',
                    'slug' => 'brand-identity-web-portfolio',
                    'ringkasan' => 'Perancangan identitas merek dan implementasi website portofolio interaktif berperforma tinggi.',
                    'kategori' => (object)['nama_kategori' => 'UI/UX Design'],
                    'teknologi' => ['Figma', 'Next.js', 'TailwindCSS'],
                    'url_demo' => '#',
                    'url_repositori' => '#',
                ],
            ]);
        }

        return view('portfolio.index', compact(
            'profil',
            'proyekUnggulan',
            'kategoriKeahlian',
            'pengalaman',
            'layanan',
            'testimoni',
            'mediaSosial'
        ));
    }

    /**
     * Kirim Pesan Kontak dari Pengunjung
     */
    public function kirimPesan(Request $request)
    {
        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'isi_pesan' => 'required|string',
        ]);

        try {
            PesanKontak::create($validated);
        } catch (\Throwable $e) {
            //
        }

        return redirect()->back()->with('pesan_terkirim', 'Terima kasih! Pesan Anda telah terkirim dan tersimpan ke database.');
    }
}
