<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Proyek;
use App\Models\KategoriProyek;
use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    /**
     * Dashboard utama CMS
     */
    public function dashboard()
    {
        $profil = null;
        $proyekList = collect([]);
        $kategoriList = collect([]);
        $pesanList = collect([]);

        try {
            $profil = Profil::first();
            $proyekList = Proyek::with('kategori')->orderBy('urutan')->orderBy('created_at', 'desc')->get();
            $kategoriList = KategoriProyek::all();
            $pesanList = PesanKontak::orderBy('created_at', 'desc')->take(5)->get();
        } catch (\Throwable $e) {
            // Jika database belum terhubung (misal MySQL belum dinyalakan di Laragon)
        }

        // Fallback default mockup jika database kosong atau belum jalan
        if (!$profil) {
            $profil = (object)[
                'nama_lengkap' => 'Fuad Bandhu',
                'panggilan' => 'Fuad',
                'jabatan' => 'Full-Stack Developer & UI/UX Designer',
                'slogan' => 'Membangun produk digital modern dengan desain presisi dan performa tinggi.',
                'ringkasan_tentang' => 'Spesialis dalam perancangan aplikasi web modern, CMS kustom, dan antarmuka pengguna interaktif.',
                'kota' => 'Jakarta',
                'negara' => 'Indonesia',
                'status_pekerjaan' => 'Tersedia untuk Pekerjaan / Freelance',
                'tahun_pengalaman' => 4,
                'total_proyek_selesai' => 25,
                'total_klien_puas' => 18,
                'email' => 'fuad@example.com',
            ];
        }

        if ($proyekList->isEmpty()) {
            $proyekList = collect([
                (object)[
                    'id' => 1,
                    'judul' => 'Fintech SaaS Dashboard',
                    'slug' => 'fintech-saas-dashboard',
                    'kategori' => (object)['nama_kategori' => 'Web Application'],
                    'tanggal_selesai' => now()->subDays(2),
                    'teknologi' => ['Laravel', 'TailwindCSS', 'MySQL'],
                    'status' => 'dipublikasi',
                    'apakah_unggulan' => true,
                    'url_demo' => 'https://example.com/demo1',
                ],
                (object)[
                    'id' => 2,
                    'judul' => 'E-Commerce Mobile Platform',
                    'slug' => 'ecommerce-mobile-platform',
                    'kategori' => (object)['nama_kategori' => 'Mobile App'],
                    'tanggal_selesai' => now()->subDays(15),
                    'teknologi' => ['React Native', 'Node.js', 'PostgreSQL'],
                    'status' => 'dipublikasi',
                    'apakah_unggulan' => true,
                    'url_demo' => 'https://example.com/demo2',
                ],
                (object)[
                    'id' => 3,
                    'judul' => 'AI Analytics & Data Tracker',
                    'slug' => 'ai-analytics-data-tracker',
                    'kategori' => (object)['nama_kategori' => 'Machine Learning'],
                    'tanggal_selesai' => now()->subDays(40),
                    'teknologi' => ['Python', 'FastAPI', 'Vue 3'],
                    'status' => 'draft',
                    'apakah_unggulan' => false,
                    'url_demo' => null,
                ],
                (object)[
                    'id' => 4,
                    'judul' => 'Brand Identity & Web Portfolio',
                    'slug' => 'brand-identity-web-portfolio',
                    'kategori' => (object)['nama_kategori' => 'UI/UX Design'],
                    'tanggal_selesai' => now()->subDays(65),
                    'teknologi' => ['Figma', 'Next.js', 'TailwindCSS'],
                    'status' => 'dipublikasi',
                    'apakah_unggulan' => true,
                    'url_demo' => 'https://example.com/demo4',
                ],
            ]);
        }

        if ($pesanList->isEmpty()) {
            $pesanList = collect([
                (object)[
                    'id' => 1,
                    'nama_pengirim' => 'Sarah Wijaya',
                    'email_pengirim' => 'sarah@perusahaan.co.id',
                    'subjek' => 'Tawaran Proyek Pembuatan Aplikasi CMS',
                    'isi_pesan' => 'Halo Fuad, kami tertarik bekerja sama untuk pembuatan platform portofolio dan dashboard internal tim.',
                    'apakah_sudah_dibaca' => false,
                    'created_at' => now()->subMinutes(12),
                ],
                (object)[
                    'id' => 2,
                    'nama_pengirim' => 'Rian Pratama',
                    'email_pengirim' => 'rian@agency.id',
                    'subjek' => 'Konsultasi UI/UX Redesign',
                    'isi_pesan' => 'Apakah Anda memiliki slot kosong bulan depan untuk redesign website landing page perusahaan?',
                    'apakah_sudah_dibaca' => false,
                    'created_at' => now()->subHours(4),
                ],
                (object)[
                    'id' => 3,
                    'nama_pengirim' => 'Andi Saputra',
                    'email_pengirim' => 'andi@startup.io',
                    'subjek' => 'Undangan Diskusi Tech Stack',
                    'isi_pesan' => 'Menghubungi Anda terkait integrasi payment gateway dan backend Laravel.',
                    'apakah_sudah_dibaca' => true,
                    'created_at' => now()->subDays(2),
                ],
            ]);
        }

        $totalProyek = $proyekList->count();
        $totalPesanBaru = $pesanList->where('apakah_sudah_dibaca', false)->count();

        return view('admin.dashboard', compact(
            'profil',
            'proyekList',
            'kategoriList',
            'pesanList',
            'totalProyek',
            'totalPesanBaru'
        ));
    }

    /**
     * Simpan proyek baru
     */
    public function simpanProyek(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|integer',
            'ringkasan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'url_demo' => 'nullable|url',
            'url_repositori' => 'nullable|url',
            'teknologi' => 'nullable|string',
            'status' => 'required|in:draft,dipublikasi,diarsipkan',
        ]);

        $teknologiArray = [];
        if (!empty($validated['teknologi'])) {
            $teknologiArray = array_map('trim', explode(',', $validated['teknologi']));
        }

        try {
            Proyek::create([
                'judul' => $validated['judul'],
                'slug' => Str::slug($validated['judul']) . '-' . time(),
                'kategori_id' => $validated['kategori_id'] ?? null,
                'ringkasan' => $validated['ringkasan'] ?? '',
                'deskripsi' => $validated['deskripsi'] ?? $validated['ringkasan'] ?? '',
                'url_demo' => $validated['url_demo'] ?? null,
                'url_repositori' => $validated['url_repositori'] ?? null,
                'teknologi' => $teknologiArray,
                'status' => $validated['status'],
                'apakah_unggulan' => $request->has('apakah_unggulan'),
                'tanggal_selesai' => now(),
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Database belum terhubung: ' . $e->getMessage());
        }

        return redirect()->back()->with('sukses', 'Proyek berhasil ditambahkan ke portofolio!');
    }

    /**
     * Update profil
     */
    public function updateProfil(Request $request)
    {
        try {
            $profil = Profil::firstOrCreate(['id' => 1]);
            $profil->update($request->only([
                'nama_lengkap', 'panggilan', 'jabatan', 'slogan',
                'ringkasan_tentang', 'deskripsi_lengkap', 'email',
                'no_telepon', 'alamat', 'kota', 'negara',
                'status_pekerjaan', 'tahun_pengalaman', 'total_proyek_selesai', 'total_klien_puas'
            ]));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Database belum terhubung: ' . $e->getMessage());
        }

        return redirect()->back()->with('sukses', 'Profil berhasil diperbarui!');
    }
}
