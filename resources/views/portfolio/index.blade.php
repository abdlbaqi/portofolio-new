<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_lengkap ?? 'Portofolio' }} — {{ $profil->jabatan ?? 'Web Developer' }}</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            lime: '#c4f745',
                            limeHover: '#b3e835',
                            dark: '#1e2025',
                            darkHover: '#2a2d34',
                            canvas: '#ffffff',
                            surface: '#f8f9fb',
                            card: '#ffffff',
                            border: '#eaedf3',
                            subtext: '#8a92a6'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #1e2025;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="w-full min-h-screen bg-white text-brand-dark antialiased">

    <div class="w-full min-h-screen flex flex-col bg-white">
        
        <!-- ================= NAVBAR ================= -->
        <header class="flex items-center justify-between px-6 lg:px-16 py-5 bg-white border-b border-brand-border sticky top-0 z-40">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-dark flex items-center justify-center relative shadow-xs">
                    <span class="w-3.5 h-3.5 rounded-full bg-brand-lime absolute -top-0.5 -right-0.5"></span>
                    <i class="fa-solid fa-code text-white text-sm"></i>
                </div>
                <div>
                    <span class="text-lg font-bold text-brand-dark tracking-tight">{{ $profil->nama_lengkap }}</span>
                    <span class="text-xs text-brand-subtext block -mt-0.5">{{ $profil->jabatan }}</span>
                </div>
            </div>

            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-brand-subtext">
                <a href="#tentang" class="hover:text-brand-dark transition">Tentang</a>
                <a href="#proyek" class="hover:text-brand-dark transition">Proyek</a>
                <a href="#kontak" class="hover:text-brand-dark transition">Kontak</a>
            </nav>

            <div class="flex items-center gap-2.5">
                <!-- CMS Dashboard Pill Link -->
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-lime text-brand-dark text-xs font-bold hover:bg-brand-limeHover transition shadow-2xs">
                    <i class="fa-solid fa-sliders text-xs"></i>
                    <span>Panel CMS</span>
                </a>

                <a href="#kontak" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-dark text-white text-xs font-bold hover:bg-brand-darkHover transition shadow-2xs">
                    <span>Hubungi Saya</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </header>

        <!-- ================= HERO SECTION ================= -->
        <section id="tentang" class="px-6 lg:px-16 py-12 lg:py-20 border-b border-brand-border bg-[#fafafc]">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Left text -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-lime text-brand-dark text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-brand-dark animate-ping"></span>
                        <span>{{ $profil->status_pekerjaan }}</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-extrabold text-brand-dark tracking-tight leading-tight">
                        {{ $profil->slogan ?? 'Membangun Produk Digital Modern dengan Desain Presisi.' }}
                    </h1>

                    <p class="text-brand-subtext text-base lg:text-lg leading-relaxed max-w-xl">
                        {{ $profil->ringkasan_tentang }}
                    </p>

                    <!-- Quick Stats row -->
                    <div class="grid grid-cols-3 gap-4 pt-2 max-w-lg">
                        <div class="bg-white p-4 rounded-2xl border border-brand-border text-center shadow-2xs">
                            <span class="text-2xl lg:text-3xl font-extrabold text-brand-dark block">{{ $profil->total_proyek_selesai ?? 25 }}+</span>
                            <span class="text-xs text-brand-subtext font-medium">Proyek Selesai</span>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-brand-border text-center shadow-2xs">
                            <span class="text-2xl lg:text-3xl font-extrabold text-brand-dark block">{{ $profil->total_klien_puas ?? 18 }}+</span>
                            <span class="text-xs text-brand-subtext font-medium">Klien Puas</span>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-brand-border text-center shadow-2xs">
                            <span class="text-2xl lg:text-3xl font-extrabold text-brand-dark block">{{ $profil->tahun_pengalaman ?? 4 }} Thn</span>
                            <span class="text-xs text-brand-subtext font-medium">Pengalaman</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <a href="#proyek" class="px-6 py-3 rounded-full bg-brand-dark text-white text-xs font-bold hover:bg-brand-darkHover transition shadow-sm inline-flex items-center gap-2">
                            <span>Jelajahi Proyek</span>
                            <i class="fa-solid fa-arrow-down text-xs"></i>
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 rounded-full bg-white text-brand-dark text-xs font-bold border border-brand-border hover:border-brand-dark transition shadow-2xs inline-flex items-center gap-2">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                            <span>Kelola Lewat CMS</span>
                        </a>
                    </div>
                </div>

                <!-- Right Feature Card matching Reference "Santander" lime card style -->
                <div class="lg:col-span-5">
                    <div class="bg-brand-lime rounded-3xl p-8 text-brand-dark shadow-xs relative overflow-hidden space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 rounded-xl bg-brand-dark text-brand-lime flex items-center justify-center font-bold text-sm">
                                    <i class="fa-solid fa-terminal"></i>
                                </span>
                                <span class="font-bold text-sm">Tech Stack Utama</span>
                            </div>
                            <span class="text-xs font-mono bg-brand-dark/10 px-2.5 py-1 rounded-md font-bold">2026 Ready</span>
                        </div>

                        <div class="space-y-2">
                            <div class="text-xs font-mono tracking-widest text-brand-dark/70">
                                <span>PHP / LARAVEL</span> • <span>TAILWIND CSS</span>
                            </div>
                            <div class="text-3xl font-extrabold tracking-tight">
                                Full-Stack Architecture
                            </div>
                            <p class="text-xs text-brand-dark/80 leading-relaxed">
                                Terintegrasi dengan database MySQL/SQLite lengkap dengan CMS dinamis sehingga setiap teks, gambar, dan proyek bisa diperbarui kapan saja.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-brand-dark/15 flex items-center justify-between text-xs font-semibold">
                            <span>Lokasi: {{ $profil->kota }}, {{ $profil->negara }}</span>
                            <span class="inline-flex items-center gap-1">
                                <i class="fa-solid fa-envelope text-xs"></i>
                                {{ $profil->email }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= PROJECTS SHOWCASE ================= -->
        <section id="proyek" class="px-6 lg:px-16 py-14 lg:py-20 border-b border-brand-border space-y-8 bg-white">
            <div class="max-w-7xl mx-auto space-y-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                    <div>
                        <span class="text-xs font-bold text-brand-subtext uppercase tracking-wider">Koleksi Karya</span>
                        <h2 class="text-3xl lg:text-4xl font-extrabold text-brand-dark tracking-tight mt-1">Proyek Pilihan</h2>
                    </div>
                    <span class="text-xs text-brand-subtext font-medium">Dikelola langsung melalui panel CMS</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($proyekUnggulan as $p)
                    <div class="bg-white rounded-3xl p-6 border border-brand-border shadow-xs hover:border-brand-lime hover:shadow-md transition group flex flex-col justify-between">
                        <div class="space-y-4">
                            <!-- Project Header Image / Icon -->
                            <div class="h-44 rounded-2xl bg-[#f8f9fb] border border-brand-border flex items-center justify-center relative overflow-hidden group-hover:bg-brand-lime/10 transition">
                                <i class="fa-solid fa-laptop-code text-4xl text-brand-dark/70 group-hover:scale-110 transition duration-300"></i>
                                <span class="absolute top-3 right-3 text-[10px] font-bold px-2.5 py-1 rounded-full bg-brand-dark text-white">
                                    {{ $p->kategori->nama_kategori ?? 'Web App' }}
                                </span>
                            </div>

                            <div>
                                <h3 class="font-bold text-lg text-brand-dark group-hover:text-emerald-700 transition">
                                    {{ $p->judul }}
                                </h3>
                                <p class="text-xs text-brand-subtext mt-1.5 leading-relaxed line-clamp-2">
                                    {{ $p->ringkasan }}
                                </p>
                            </div>

                            <!-- Tech tags -->
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                @php
                                    $teknologi = is_array($p->teknologi) ? $p->teknologi : json_decode($p->teknologi ?? '[]', true);
                                @endphp
                                @foreach($teknologi ?? ['Laravel', 'Tailwind'] as $tek)
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-brand-surface text-brand-dark border border-brand-border">
                                        {{ $tek }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-t border-brand-border/60 flex items-center justify-between">
                            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live Selesai
                            </span>
                            @if(!empty($p->url_demo))
                                <a href="{{ $p->url_demo }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-brand-dark hover:underline">
                                    <span>Lihat Demo</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ================= CONTACT FORM ================= -->
        <section id="kontak" class="px-6 lg:px-16 py-14 lg:py-20 bg-[#fafafc]">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-5 space-y-4">
                    <span class="text-xs font-bold text-brand-subtext uppercase tracking-wider">Terhubung</span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-brand-dark tracking-tight">Kirim Pesan / Konsultasi</h2>
                    <p class="text-sm text-brand-subtext leading-relaxed">
                        Pesan yang Anda kirimkan melalui formulir ini akan langsung masuk ke tabel database <strong class="text-brand-dark">`pesan_kontak`</strong> dan muncul di notifikasi panel CMS.
                    </p>

                    <div class="bg-white p-5 rounded-2xl border border-brand-border space-y-3 mt-4 shadow-2xs">
                        <div class="flex items-center gap-3 text-xs text-brand-dark font-medium">
                            <i class="fa-solid fa-envelope text-brand-subtext"></i>
                            <span>{{ $profil->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-brand-dark font-medium">
                            <i class="fa-solid fa-location-dot text-brand-subtext"></i>
                            <span>{{ $profil->kota }}, {{ $profil->negara }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    @if(session('pesan_terkirim'))
                        <div class="p-4 mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                            <span>{{ session('pesan_terkirim') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST" class="bg-white p-8 rounded-3xl border border-brand-border space-y-4 shadow-xs">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-brand-dark mb-1">Nama Lengkap</label>
                                <input type="text" name="nama_pengirim" required placeholder="Nama Anda" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-4 py-2.5 text-brand-dark focus:border-brand-dark focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-brand-dark mb-1">Email</label>
                                <input type="email" name="email_pengirim" required placeholder="email@contoh.com" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-4 py-2.5 text-brand-dark focus:border-brand-dark focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-brand-dark mb-1">Subjek</label>
                            <input type="text" name="subjek" required placeholder="Tawaran proyek / diskusi" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-4 py-2.5 text-brand-dark focus:border-brand-dark focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-brand-dark mb-1">Isi Pesan</label>
                            <textarea name="isi_pesan" rows="3" required placeholder="Jelaskan kebutuhan proyek atau pesan Anda..." class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-4 py-2.5 text-brand-dark focus:border-brand-dark focus:outline-none"></textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="px-6 py-3 rounded-full bg-brand-dark text-white text-xs font-bold hover:bg-brand-darkHover transition shadow-xs inline-flex items-center gap-2">
                                <span>Kirim Pesan</span>
                                <i class="fa-solid fa-paper-plane text-[10px]"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- ================= FOOTER ================= -->
        <footer class="px-6 lg:px-16 py-6 bg-white border-t border-brand-border flex flex-col sm:flex-row items-center justify-between text-xs text-brand-subtext gap-3">
            <span>© {{ date('Y') }} {{ $profil->nama_lengkap }}. Seluruh hak cipta dilindungi.</span>
            <div class="flex items-center gap-4 font-semibold text-brand-dark">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-brand-lime"></span>
                    <span>Kelola lewat Panel CMS</span>
                </a>
            </div>
        </footer>

    </div>

</body>
</html>
