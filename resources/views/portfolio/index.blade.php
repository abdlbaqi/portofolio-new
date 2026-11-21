<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_lengkap ?? 'Fuad Abdul Baqi' }} — Web Developer</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        neo: {
                            lime: '#c4f745',
                            limeHover: '#b2e835',
                            dark: '#0f1115',
                            darkCard: '#15181f',
                            darkHover: '#1c2029',
                            emerald: '#10b981',
                            surface: '#f8f9fb',
                            card: '#ffffff',
                            border: '#eaedf3',
                            subtext: '#64748b'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'sans-serif'],
                    },
                    keyframes: {
                        floatSlow: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    },
                    animation: {
                        floatSlow: 'floatSlow 4.5s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #0f1115;
            -webkit-font-smoothing: antialiased;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .animated-chart-line {
            stroke-dasharray: 600;
            stroke-dashoffset: 600;
            animation: drawLine 1.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes drawLine {
            to {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>
<body class="w-full min-h-screen bg-white text-neo-dark antialiased selection:bg-neo-lime selection:text-neo-dark" x-data="{
    navScrolled: false,
    bentoTab: 'skills',
    filterProyek: 'semua',
    metricStatA: '25+',
    metricStatB: '18+',
    badgeLabelA: 'Selesai',
    badgeLabelB: 'Klien Senang',
    pilihKategori(kat) {
        this.filterProyek = kat;
        if(kat === 'semua') {
            this.metricStatA = '25+';
            this.metricStatB = '18+';
            this.badgeLabelA = 'Selesai';
            this.badgeLabelB = 'Klien Senang';
        } else if(kat === 'webapp') {
            this.metricStatA = '14';
            this.metricStatB = '100%';
            this.badgeLabelA = 'Aplikasi Web';
            this.badgeLabelB = 'Uptime';
        } else if(kat === 'landing') {
            this.metricStatA = '8';
            this.metricStatB = '<1s';
            this.badgeLabelA = 'Landing Page';
            this.badgeLabelB = 'Load Cepat';
        } else {
            this.metricStatA = '3';
            this.metricStatB = 'Custom';
            this.badgeLabelA = 'Sistem CMS';
            this.badgeLabelB = 'Dashboard';
        }
    }
}" @scroll.window="navScrolled = (window.pageYOffset > 30)">

    <!-- ======================================================== -->
    <!-- 1. NAVBAR                                                -->
    <!-- ======================================================== -->
    <header class="w-full fixed top-0 left-0 z-50 px-4 sm:px-8 transition-all duration-300"
            :class="navScrolled ? 'pt-2 pb-2 bg-white/90 backdrop-blur-md shadow-xs border-b border-neo-border' : 'pt-4 pb-2 bg-transparent'">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-2 group">
                <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-neo-dark">
                    {{ $profil->nama_lengkap ?? 'Fuad Abdul Baqi' }}
                </span>
            </a>

            <!-- Center Floating Menu -->
            <nav class="hidden md:flex items-center gap-1 px-4 py-2 rounded-full bg-[#f4f5f8] border border-neo-border shadow-xs text-xs font-semibold text-neo-subtext">
                <a href="#tentang" class="px-3.5 py-1.5 rounded-full hover:text-neo-dark hover:bg-white transition">Tentang</a>
                <a href="#keahlian" class="px-3.5 py-1.5 rounded-full hover:text-neo-dark hover:bg-white transition">Keahlian</a>
                <a href="#proyek" class="px-3.5 py-1.5 rounded-full hover:text-neo-dark hover:bg-white transition">Proyek</a>
                <a href="#faq" class="px-3.5 py-1.5 rounded-full hover:text-neo-dark hover:bg-white transition">Tanya Jawab</a>
                <a href="#kontak" class="px-3.5 py-1.5 rounded-full hover:text-neo-dark hover:bg-white transition">Kontak</a>
            </nav>

            <!-- Right Controls -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.login') }}" class="text-xs font-semibold text-neo-subtext hover:text-neo-dark transition px-2 py-1">
                    Panel CMS
                </a>
                <a href="#kontak" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-neo-dark text-white text-xs font-bold hover:bg-black active:scale-95 transition-all shadow-xs">
                    <span>Hubungi Saya</span>
                    <i class="fa-solid fa-arrow-right text-[10px] text-neo-lime"></i>
                </a>
            </div>
        </div>
    </header>

    <div class="h-24 sm:h-28"></div>

    <!-- ======================================================== -->
    <!-- 2. HERO SECTION                                          -->
    <!-- ======================================================== -->
    <section id="tentang" class="px-4 sm:px-8 pt-6 pb-16 lg:pb-20 reveal-on-scroll is-visible bg-white">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            
            <!-- Availability Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-neo-surface border border-neo-border text-xs font-semibold text-neo-dark">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>{{ $profil->status_pekerjaan ?? 'Tersedia untuk project baru & freelance' }}</span>
            </div>

            <!-- Headline -->
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-neo-dark leading-tight">
                Halo, saya {{ $profil->panggilan ?? 'Fuad' }}.<br/>
                <span class="text-neo-subtext font-normal text-3xl sm:text-5xl">Saya bantu kembangkan website yang rapi dan gampang dipakai.</span>
            </h1>

            <!-- Description -->
            <p class="text-neo-subtext text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                Fokus utama saya di backend Laravel dan frontend Tailwind CSS. Biasa ngerjain pembuatan aplikasi web dari rancangan database sampai halaman admin CMS yang siap pakai.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="#proyek" class="px-6 py-3.5 rounded-xl bg-neo-dark text-white text-sm font-bold hover:bg-black active:scale-95 transition-all shadow-md inline-flex items-center gap-2 group">
                    <span>Lihat Hasil Proyek</span>
                    <i class="fa-solid fa-arrow-down text-xs text-neo-lime group-hover:translate-y-0.5 transition-transform"></i>
                </a>

                <a href="#kontak" class="px-6 py-3.5 rounded-xl bg-white border border-neo-border text-neo-dark text-sm font-bold hover:border-neo-dark active:scale-95 transition-all shadow-2xs inline-flex items-center gap-2">
                    <span>Ngobrol Santai</span>
                </a>
            </div>

            <!-- Hero Feature Card -->
            <div class="pt-8">
                <div class="w-full max-w-4xl mx-auto rounded-[32px] bg-neo-darkCard p-7 sm:p-12 relative overflow-hidden shadow-xl text-left text-white border border-neo-border/20">
                    
                    <!-- Decorative Layered Colored Cards on top -->
                    <div class="absolute -top-3 left-10 right-10 h-6 bg-neo-lime rounded-t-3xl opacity-90 -z-0"></div>
                    <div class="absolute top-1 left-6 right-6 h-6 bg-[#252a36] rounded-t-3xl opacity-95 -z-0"></div>

                    <!-- Inner Content -->
                    <div class="relative z-10 max-w-md space-y-3 pt-2">
                        <span class="text-xs font-mono font-bold text-neo-lime tracking-wide uppercase">
                            Pendekatan Kerja
                        </span>
                        
                        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                            Bikin website yang beneran jalan dan gampang dirawat.
                        </h2>
                        
                        <p class="text-white/70 text-sm leading-relaxed">
                            Bukan cuma bagus di tampilan luar, tapi kodingannya rapi, struktur database jelas, dan ada dashboard CMS buat update isi konten sendiri tanpa harus utak-atik script.
                        </p>
                    </div>

                    <!-- Visual Lime Card -->
                    <div class="absolute right-6 sm:right-12 bottom-6 sm:bottom-10 flex items-end gap-4 pointer-events-none">
                        <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-3xl bg-neo-lime p-2 shadow-xl flex items-center justify-center animate-floatSlow">
                            <div class="w-full h-full rounded-[22px] bg-neo-dark flex flex-col justify-between p-4 text-white shadow-inner">
                                <div class="flex items-center justify-between">
                                    <span class="w-5 h-5 rounded-md bg-neo-lime/20 flex items-center justify-center text-neo-lime text-[10px]">
                                        <i class="fa-solid fa-database"></i>
                                    </span>
                                    <span class="text-[10px] font-mono text-white/50">CMS</span>
                                </div>
                                <div>
                                    <span class="text-[10px] text-white/60 block font-mono">Database</span>
                                    <span class="text-xs font-bold text-neo-lime font-mono">BAHASA INDO</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tech Stack Badges -->
                    <div class="relative z-10 pt-8 flex flex-wrap items-center gap-2.5 text-xs font-semibold text-white/90">
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/15">
                            <i class="fa-brands fa-laravel text-neo-lime"></i>
                            <span>Laravel 11</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/15">
                            <i class="fa-solid fa-database text-neo-lime"></i>
                            <span>MySQL</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl border border-white/15">
                            <i class="fa-brands fa-css3-alt text-neo-lime"></i>
                            <span>Tailwind CSS</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 3. KEAHLIAN & CARA KERJA (Bento Grid)                    -->
    <!-- ======================================================== -->
    <section id="keahlian" class="px-4 sm:px-8 py-16 bg-white reveal-on-scroll">
        <div class="max-w-6xl mx-auto space-y-10">
            
            <!-- Section Header -->
            <div class="text-center space-y-2">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-neo-dark tracking-tight">
                    Tools & Cara Kerja Saya
                </h2>
                <p class="text-neo-subtext text-sm sm:text-base max-w-lg mx-auto">
                    Teknologi yang sehari-hari saya gunakan untuk membangun aplikasi web dari awal.
                </p>
            </div>

            <!-- Bento 2-Column Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-7 items-stretch">
                
                <!-- KARTU 1 (Kiri): Tabbed Stack / Tools -->
                <div class="lg:col-span-5 bg-neo-surface rounded-[32px] p-6 sm:p-8 border border-neo-border shadow-xs flex flex-col justify-between space-y-5">
                    
                    <!-- Tabs -->
                    <div class="flex items-center gap-1 bg-white p-1 rounded-2xl border border-neo-border">
                        <button @click="bentoTab = 'skills'" 
                                :class="bentoTab === 'skills' ? 'bg-neo-dark text-white font-bold' : 'text-neo-subtext hover:text-neo-dark'"
                                class="px-3 py-1.5 rounded-xl text-xs transition">
                            Skill Utama
                        </button>
                        <button @click="bentoTab = 'tags'" 
                                :class="bentoTab === 'tags' ? 'bg-neo-dark text-white font-bold' : 'text-neo-subtext hover:text-neo-dark'"
                                class="px-3 py-1.5 rounded-xl text-xs transition">
                            Tools Lainnya
                        </button>
                        <button @click="bentoTab = 'uptime'" 
                                :class="bentoTab === 'uptime' ? 'bg-neo-dark text-white font-bold' : 'text-neo-subtext hover:text-neo-dark'"
                                class="px-3 py-1.5 rounded-xl text-xs transition">
                            Standar Kode
                        </button>
                    </div>

                    <!-- TAB 1: Skill Utama -->
                    <div x-show="bentoTab === 'skills'" x-transition class="space-y-3.5">
                        <h4 class="text-xs font-bold text-neo-subtext uppercase tracking-wider">Bahasa & Framework</h4>
                        
                        <!-- PHP / Laravel -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-xs font-bold text-neo-dark">
                                <span>PHP & Laravel</span>
                                <span class="text-neo-subtext">90%</span>
                            </div>
                            <div class="h-2.5 w-full bg-white rounded-full overflow-hidden border border-neo-border">
                                <div class="h-full bg-neo-dark rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>

                        <!-- Tailwind CSS -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-xs font-bold text-neo-dark">
                                <span>Tailwind CSS</span>
                                <span class="text-neo-subtext">90%</span>
                            </div>
                            <div class="h-2.5 w-full bg-white rounded-full overflow-hidden border border-neo-border">
                                <div class="h-full bg-neo-lime rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>

                        <!-- MySQL -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-xs font-bold text-neo-dark">
                                <span>MySQL Database</span>
                                <span class="text-neo-subtext">85%</span>
                            </div>
                            <div class="h-2.5 w-full bg-white rounded-full overflow-hidden border border-neo-border">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: 85%;"></div>
                            </div>
                        </div>

                        <!-- JavaScript / Vue -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-xs font-bold text-neo-dark">
                                <span>JavaScript / Vue.js</span>
                                <span class="text-neo-subtext">80%</span>
                            </div>
                            <div class="h-2.5 w-full bg-white rounded-full overflow-hidden border border-neo-border">
                                <div class="h-full bg-neo-dark/70 rounded-full" style="width: 80%;"></div>
                            </div>
                        </div>

                        <!-- REST API -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-xs font-bold text-neo-dark">
                                <span>RESTful API</span>
                                <span class="text-neo-subtext">85%</span>
                            </div>
                            <div class="h-2.5 w-full bg-white rounded-full overflow-hidden border border-neo-border">
                                <div class="h-full bg-neo-lime rounded-full" style="width: 85%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: Tools Ekosistem -->
                    <div x-show="bentoTab === 'tags'" x-cloak x-transition class="py-2 space-y-3">
                        <h4 class="text-xs font-bold text-neo-subtext uppercase tracking-wider">Tools Pendukung</h4>
                        <div class="flex flex-wrap gap-2 p-3 bg-white rounded-2xl border border-neo-border">
                            <span class="px-3 py-1.5 rounded-full border border-neo-border text-xs font-medium hover:border-neo-dark transition cursor-default">Git & GitHub</span>
                            <span class="px-3 py-1.5 rounded-full bg-neo-dark text-white text-xs font-medium">Laragon</span>
                            <span class="px-3 py-1.5 rounded-full border border-neo-border text-xs font-medium hover:border-neo-dark transition cursor-default">Postman</span>
                            <span class="px-3 py-1.5 rounded-full bg-neo-lime text-neo-dark text-xs font-bold">Vite</span>
                            <span class="px-3 py-1.5 rounded-full border border-neo-border text-xs font-medium hover:border-neo-dark transition cursor-default">Figma</span>
                            <span class="px-3 py-1.5 rounded-full border border-neo-border text-xs font-medium hover:border-neo-dark transition cursor-default">Composer</span>
                            <span class="px-3 py-1.5 rounded-full border border-neo-border text-xs font-medium hover:border-neo-dark transition cursor-default">Alpine.js</span>
                            <span class="px-3 py-1.5 rounded-full border border-neo-border text-xs font-medium hover:border-neo-dark transition cursor-default">HeidiSQL</span>
                        </div>
                    </div>

                    <!-- TAB 3: Standar Kode -->
                    <div x-show="bentoTab === 'uptime'" x-cloak x-transition class="space-y-3">
                        <h4 class="text-xs font-bold text-neo-subtext uppercase tracking-wider">Prinsip Pembuatan</h4>
                        <ul class="text-xs text-neo-subtext space-y-2 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-500 mt-0.5"></i>
                                <span><strong>Struktur MVC Bersih:</strong> Kode rapi, gampang dibaca orang lain atau dikembangkan lagi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-500 mt-0.5"></i>
                                <span><strong>Database Terencana:</strong> Relasi tabel jelas, indeks rapi, query cepat.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-500 mt-0.5"></i>
                                <span><strong>Keamanan Dasar:</strong> Sudah ada proteksi CSRF, sanitasi input, dan enkripsi password.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Bottom Accent Bar -->
                    <div class="h-1.5 w-full rounded-full bg-gradient-to-r from-neo-dark via-neo-lime to-emerald-400 mt-2"></div>
                </div>

                <!-- KARTU 2 (Kanan): Pengalaman & Proyek -->
                <div class="lg:col-span-7 bg-neo-surface rounded-[32px] p-6 sm:p-8 border border-neo-border shadow-xs flex flex-col justify-between space-y-6">
                    
                    <!-- Header with Filter -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-bold text-neo-dark tracking-tight">
                                Pengalaman & Hasil Pengerjaan
                            </h3>
                            <p class="text-xs text-neo-subtext">Statistik project yang pernah diselesaikan</p>
                        </div>

                        <!-- Simple Filter Pill -->
                        <div class="inline-flex items-center bg-white border border-neo-border rounded-full p-1 text-[11px] font-semibold text-neo-subtext">
                            <button @click="pilihKategori('semua')" :class="filterProyek === 'semua' ? 'bg-neo-dark text-white font-bold' : 'hover:text-neo-dark'" class="px-2.5 py-1 rounded-full transition">Semua</button>
                            <button @click="pilihKategori('webapp')" :class="filterProyek === 'webapp' ? 'bg-neo-dark text-white font-bold' : 'hover:text-neo-dark'" class="px-2.5 py-1 rounded-full transition">Web App</button>
                            <button @click="pilihKategori('landing')" :class="filterProyek === 'landing' ? 'bg-neo-dark text-white font-bold' : 'hover:text-neo-dark'" class="px-2.5 py-1 rounded-full transition">Landing</button>
                            <button @click="pilihKategori('cms')" :class="filterProyek === 'cms' ? 'bg-neo-dark text-white font-bold' : 'hover:text-neo-dark'" class="px-2.5 py-1 rounded-full transition">CMS</button>
                        </div>
                    </div>

                    <!-- Two Big Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-neo-lime rounded-2xl p-5 text-neo-dark shadow-2xs space-y-1">
                            <span class="text-xs font-semibold block" x-text="badgeLabelA">Proyek Selesai</span>
                            <div class="text-4xl font-extrabold tracking-tight" x-text="metricStatA">
                                25+
                            </div>
                            <p class="text-[11px] font-medium text-neo-dark/70">Sudah online dan dipakai klien</p>
                        </div>

                        <div class="bg-neo-dark rounded-2xl p-5 text-white shadow-2xs space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-white/70" x-text="badgeLabelB">Klien Senang</span>
                                <span class="w-2 h-2 rounded-full bg-neo-lime"></span>
                            </div>
                            <div class="text-4xl font-extrabold tracking-tight text-white" x-text="metricStatB">
                                18+
                            </div>
                            <p class="text-[11px] font-medium text-white/60">Bisnis & perorangan</p>
                        </div>
                    </div>

                    <!-- Riwayat Pengerjaan SVG -->
                    <div class="relative pt-2">
                        <div class="flex items-center justify-between text-xs text-neo-subtext mb-2">
                            <span>Aktivitas Pengerjaan</span>
                            <span class="font-mono text-[11px] font-semibold text-neo-dark">Tahun Ini</span>
                        </div>
                        <svg viewBox="0 0 500 110" class="w-full h-24 overflow-visible">
                            <line x1="0" y1="35" x2="500" y2="35" stroke="#eaedf3" stroke-width="1" stroke-dasharray="3"/>
                            <line x1="0" y1="80" x2="500" y2="80" stroke="#eaedf3" stroke-width="1" stroke-dasharray="3"/>
                            
                            <path d="M 0,80 C 80,80 120,55 170,70 C 220,85 280,95 330,70 C 390,45 440,25 500,15" 
                                  fill="none" 
                                  stroke="#10b981" 
                                  stroke-width="3.5" 
                                  stroke-linecap="round"
                                  class="animated-chart-line"/>

                            <circle cx="170" cy="70" r="4.5" fill="#10b981"/>
                            <circle cx="390" cy="45" r="4.5" fill="#10b981"/>
                        </svg>

                        <div class="flex justify-between text-[11px] font-medium text-neo-subtext px-1 pt-1 border-t border-neo-border">
                            <span>Kuartal 1</span>
                            <span>Kuartal 2</span>
                            <span>Kuartal 3</span>
                            <span>Kuartal 4</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 4. DAFTAR PROYEK                                         -->
    <!-- ======================================================== -->
    <section id="proyek" class="px-4 sm:px-8 py-16 bg-[#fafafc] border-y border-neo-border reveal-on-scroll">
        <div class="max-w-6xl mx-auto space-y-10">
            
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                <div>
                    <span class="text-xs font-bold text-neo-dark uppercase tracking-wider flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-neo-lime"></span>
                        Portofolio
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neo-dark tracking-tight mt-1">
                        Beberapa Proyek yang Pernah Saya Buat
                    </h2>
                </div>
                <p class="text-xs text-neo-subtext">Semua proyek di bawah bisa diupdate lewat CMS</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($proyekUnggulan as $p)
                <div class="bg-white rounded-3xl p-6 border border-neo-border shadow-2xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <!-- Card Thumbnail -->
                        <div class="h-44 rounded-2xl bg-neo-surface border border-neo-border flex items-center justify-center relative overflow-hidden group-hover:bg-neo-lime/10 transition">
                            <i class="fa-solid fa-laptop-code text-4xl text-neo-dark/60 group-hover:scale-105 transition"></i>
                            <span class="absolute top-3 right-3 text-[10px] font-bold px-2.5 py-1 rounded-full bg-neo-dark text-white">
                                {{ $p->kategori->nama_kategori ?? 'Aplikasi' }}
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-base text-neo-dark group-hover:text-emerald-700 transition">
                                {{ $p->judul }}
                            </h3>
                            <p class="text-xs text-neo-subtext mt-1.5 leading-relaxed line-clamp-2">
                                {{ $p->ringkasan }}
                            </p>
                        </div>

                        <!-- Tech tags -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @php
                                $teknologi = is_array($p->teknologi) ? $p->teknologi : json_decode($p->teknologi ?? '[]', true);
                            @endphp
                            @foreach($teknologi ?? ['Laravel', 'Tailwind'] as $tek)
                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-neo-surface text-neo-dark border border-neo-border">
                                    {{ $tek }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-neo-border flex items-center justify-between">
                        <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                        @if(!empty($p->url_demo))
                            <a href="{{ $p->url_demo }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-neo-dark hover:underline">
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

    <!-- ======================================================== -->
    <!-- 5. FAQ                                                   -->
    <!-- ======================================================== -->
    <section id="faq" class="px-4 sm:px-8 py-16 bg-white reveal-on-scroll" x-data="{ activeFaq: null }">
        <div class="max-w-3xl mx-auto space-y-10">
            
            <div class="text-center space-y-2">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-neo-dark tracking-tight">
                    Pertanyaan yang Sering Ditanyakan
                </h2>
                <p class="text-xs sm:text-sm text-neo-subtext">Hal umum seputar sistem website dan panel CMS ini.</p>
            </div>

            <!-- Accordion items -->
            <div class="divide-y divide-neo-border">
                
                <!-- FAQ 1 -->
                <div class="py-4">
                    <button @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full flex items-center justify-between text-left font-bold text-sm sm:text-base text-neo-dark hover:text-emerald-700 transition">
                        <span>Kalau mau nambah atau edit portofolio, harus ngoding lagi nggak?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-neo-subtext transition duration-200" :class="activeFaq === 1 ? 'rotate-180 text-neo-dark' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse x-cloak class="pt-2 text-xs sm:text-sm text-neo-subtext leading-relaxed">
                        Nggak perlu. Website ini sudah ada panel CMS di <code>/admin</code>. Anda cukup login, isi form judul, deskripsi, upload foto, lalu klik simpan. Datanya otomatis langsung tampil di sini.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="py-4">
                    <button @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full flex items-center justify-between text-left font-bold text-sm sm:text-base text-neo-dark hover:text-emerald-700 transition">
                        <span>Bisa custom fitur atau nambah halaman baru?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-neo-subtext transition duration-200" :class="activeFaq === 2 ? 'rotate-180 text-neo-dark' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse x-cloak class="pt-2 text-xs sm:text-sm text-neo-subtext leading-relaxed">
                        Bisa banget. Kodenya terstruktur rapi pakai Laravel standar dan Tailwind CSS, jadi sangat gampang kalau mau ditambah fitur baru seperti payment gateway, integrasi WhatsApp, atau ganti tata letak.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="py-4">
                    <button @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full flex items-center justify-between text-left font-bold text-sm sm:text-base text-neo-dark hover:text-emerald-700 transition">
                        <span>Tampilannya sudah pas dibuka di smartphone?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-neo-subtext transition duration-200" :class="activeFaq === 3 ? 'rotate-180 text-neo-dark' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse x-cloak class="pt-2 text-xs sm:text-sm text-neo-subtext leading-relaxed">
                        Sudah responsif. Tata letak akan otomatis menyesuaikan layar HP, tablet, maupun monitor komputer agar tetap enak dibaca.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="py-4">
                    <button @click="activeFaq = (activeFaq === 4 ? null : 4)" class="w-full flex items-center justify-between text-left font-bold text-sm sm:text-base text-neo-dark hover:text-emerald-700 transition">
                        <span>Pesan yang dikirim lewat formulir masuknya ke mana?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-neo-subtext transition duration-200" :class="activeFaq === 4 ? 'rotate-180 text-neo-dark' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse x-cloak class="pt-2 text-xs sm:text-sm text-neo-subtext leading-relaxed">
                        Pesan langsung tersimpan aman di database tabel <code>pesan_kontak</code> dan bisa langsung Anda baca serta balas di notifikasi panel admin.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 6. KONTAK                                                -->
    <!-- ======================================================== -->
    <section id="kontak" class="px-4 sm:px-8 py-16 bg-neo-surface border-t border-neo-border reveal-on-scroll">
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <div class="lg:col-span-5 space-y-4">
                <span class="text-xs font-bold text-neo-dark uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-neo-lime"></span>
                    Kontak
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-neo-dark tracking-tight">
                    Tertarik Bikin Project Bareng?
                </h2>
                <p class="text-sm text-neo-subtext leading-relaxed">
                    Kalau punya ide aplikasi, mau konsultasi kebutuhan website, atau tanya-tanya estimasi pengerjaan, silakan tinggalkan pesan lewat formulir ini ya.
                </p>

                <div class="bg-white p-5 rounded-2xl border border-neo-border space-y-3 mt-4 shadow-2xs">
                    <div class="flex items-center gap-3 text-xs font-semibold text-neo-dark">
                        <i class="fa-solid fa-envelope text-neo-subtext"></i>
                        <span>{{ $profil->email }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs font-semibold text-neo-dark">
                        <i class="fa-solid fa-location-dot text-neo-lime"></i>
                        <span>{{ $profil->kota ?? 'Bandung' }}, {{ $profil->negara ?? 'Indonesia' }}</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-7">
                @if(session('pesan_terkirim'))
                    <div class="p-4 mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                        <span>{{ session('pesan_terkirim') }}</span>
                    </div>
                @endif

                <form action="{{ route('kontak.kirim') }}" method="POST" class="bg-white p-6 sm:p-8 rounded-3xl border border-neo-border shadow-2xs space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neo-dark mb-1">Nama Anda</label>
                            <input type="text" name="nama_pengirim" required placeholder="Nama lengkap atau panggilan" class="w-full text-sm bg-neo-surface border border-neo-border rounded-xl px-3.5 py-2 text-neo-dark focus:border-neo-dark focus:bg-white focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-neo-dark mb-1">Email Anda</label>
                            <input type="email" name="email_pengirim" required placeholder="nama@email.com" class="w-full text-sm bg-neo-surface border border-neo-border rounded-xl px-3.5 py-2 text-neo-dark focus:border-neo-dark focus:bg-white focus:outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neo-dark mb-1">Topik / Keperluan</label>
                        <input type="text" name="subjek" required placeholder="Misal: Pembuatan web profil / Tanya estimasi biaya" class="w-full text-sm bg-neo-surface border border-neo-border rounded-xl px-3.5 py-2 text-neo-dark focus:border-neo-dark focus:bg-white focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neo-dark mb-1">Pesan</label>
                        <textarea name="isi_pesan" rows="3" required placeholder="Ceritakan singkat kebutuhan atau pertanyaan Anda..." class="w-full text-sm bg-neo-surface border border-neo-border rounded-xl px-3.5 py-2 text-neo-dark focus:border-neo-dark focus:bg-white focus:outline-none transition"></textarea>
                    </div>

                    <div class="flex items-center justify-end pt-1">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-neo-dark text-white text-xs font-bold hover:bg-black active:scale-95 transition-all shadow-xs inline-flex items-center gap-2">
                            <span>Kirimkan Pesan</span>
                            <i class="fa-solid fa-paper-plane text-[10px] text-neo-lime"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 7. FOOTER                                                -->
    <!-- ======================================================== -->
    <footer class="px-4 sm:px-8 py-6 bg-white border-t border-neo-border">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between text-xs text-neo-subtext gap-3">
            <div class="flex items-center gap-2">
                <span class="font-bold text-neo-dark">{{ $profil->nama_lengkap }}</span>
                <span>• © {{ date('Y') }}. Dibuat dengan Laravel & Tailwind.</span>
            </div>

            <div class="flex items-center gap-4 font-semibold text-neo-dark">
                <a href="#tentang" class="hover:underline">Tentang</a>
                <a href="#proyek" class="hover:underline">Proyek</a>
                <a href="{{ route('admin.login') }}" class="hover:underline flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-neo-lime"></span>
                    <span>Masuk CMS Admin</span>
                </a>
            </div>
        </div>
    </footer>

    <!-- Reveal script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            });

            document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

</body>
</html>
