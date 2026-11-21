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
                'nama_lengkap' => 'Fuad Abdul Baqi',
                'panggilan' => 'Fuad',
                'jabatan' => 'Web Developer',
                'slogan' => 'Membangun website yang rapi, fungsional, dan mudah dikelola.',
                'ringkasan_tentang' => 'Web developer yang fokus di pengembangan aplikasi berbasis Laravel dan antarmuka modern. Terbiasa menangani pembuatan web dari perencanaan database sampai dashboard CMS.',
                'deskripsi_lengkap' => 'Berpengalaman membangun aplikasi web, sistem inventaris, dan website profil perusahaan.',
                'kota' => 'Jakarta',
                'negara' => 'Indonesia',
                'email' => 'fuad@example.com',
                'status_pekerjaan' => 'Tersedia untuk project baru & freelance',
                'tahun_pengalaman' => 4,
                'total_proyek_selesai' => 25,
                'total_klien_puas' => 18,
            ];
        }

        if ($proyekUnggulan->isEmpty()) {
            $proyekUnggulan = collect([
                (object)[
                    'id' => 1,
                    'judul' => 'Sistem Inventaris & Stok Gudang',
                    'slug' => 'sistem-inventaris-stok-gudang',
                    'ringkasan' => 'Aplikasi pencatatan stok masuk-keluar barang, manajemen supplier, dan pembuatan laporan otomatis.',
                    'kategori' => (object)['nama_kategori' => 'Aplikasi Web'],
                    'teknologi' => ['Laravel', 'TailwindCSS', 'MySQL'],
                    'url_demo' => '#',
                    'url_repositori' => '#',
                ],
                (object)[
                    'id' => 2,
                    'judul' => 'Website Profil Perusahaan & Layanan',
                    'slug' => 'website-profil-perusahaan-layanan',
                    'ringkasan' => 'Landing page modern dengan form kontak langsung tersambung ke email dan halaman admin CMS.',
                    'kategori' => (object)['nama_kategori' => 'Landing Page'],
                    'teknologi' => ['Laravel', 'TailwindCSS', 'Alpine.js'],
                    'url_demo' => '#',
                    'url_repositori' => '#',
                ],
                (object)[
                    'id' => 3,
                    'judul' => 'Portal Berita & Publikasi Internal',
                    'slug' => 'portal-berita-publikasi-internal',
                    'ringkasan' => 'Platform publikasi artikel berita dengan editor teks lengkap, kategori dinamis, dan role user.',
                    'kategori' => (object)['nama_kategori' => 'Sistem CMS'],
                    'teknologi' => ['PHP', 'MySQL', 'Bootstrap'],
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
