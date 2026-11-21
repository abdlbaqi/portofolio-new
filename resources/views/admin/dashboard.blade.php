@extends('layouts.admin')

@section('title', 'PortoCMS — Dashboard')

@section('content')
<div x-data="{ 
    modalTambahProyek: false, 
    modalEditProfil: false,
    tabNotifikasi: 'semua',
    modeGelap: false,
    cariProyek: '',
    filterStatus: 'semua'
}" class="flex flex-col lg:flex-row flex-1 w-full min-h-screen lg:h-screen lg:overflow-hidden bg-white">

    <!-- ======================================================== -->
    <!-- 1. LEFT SIDEBAR (Full-Height Edge-to-Edge)                -->
    <!-- ======================================================== -->
    <aside class="w-full lg:w-[270px] bg-white border-b lg:border-b-0 lg:border-r border-brand-border p-6 flex flex-col justify-between shrink-0 overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="flex items-center gap-2.5 mb-8">
                <div class="w-9 h-9 rounded-full bg-brand-dark flex items-center justify-center relative shadow-xs">
                    <span class="w-3.5 h-3.5 rounded-full bg-brand-lime absolute -top-0.5 -right-0.5"></span>
                    <i class="fa-solid fa-code text-white text-sm"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-brand-dark">Porto<span class="text-brand-dark">Talk</span></span>
            </div>

            <!-- User Profile Card -->
            <div class="flex flex-col items-center text-center p-4 mb-6 rounded-2xl bg-[#fafafc] border border-brand-border/80 shadow-2xs relative group cursor-pointer hover:border-brand-lime transition">
                <div class="relative mb-2">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=160&q=80" 
                         alt="{{ $profil->nama_lengkap }}" 
                         class="w-16 h-16 rounded-2xl object-cover shadow-2xs">
                    <span class="w-3.5 h-3.5 bg-brand-lime border-2 border-white rounded-full absolute -bottom-1 -right-1"></span>
                </div>
                <div class="flex items-center gap-1.5 font-semibold text-brand-dark text-base">
                    <span>{{ $profil->nama_lengkap }}</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-brand-subtext group-hover:text-brand-dark transition"></i>
                </div>
                <p class="text-xs text-brand-subtext mt-0.5">{{ $profil->kota }}, {{ $profil->negara }}</p>
            </div>

            <!-- Navigation Menu -->
            <nav class="space-y-1.5">
                <!-- Active Dashboard item -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl bg-brand-dark text-white font-medium shadow-xs transition">
                    <i class="fa-solid fa-table-cells-large text-sm text-brand-lime"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <!-- Projects -->
                <a href="#proyek-section" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface font-medium transition">
                    <div class="flex items-center gap-3.5">
                        <i class="fa-regular fa-folder-closed text-sm"></i>
                        <span class="text-sm">Proyek & Karya</span>
                    </div>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-brand-border text-brand-dark">{{ $totalProyek }}</span>
                </a>

                <!-- Skills -->
                <a href="#keahlian" class="flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface font-medium transition">
                    <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
                    <span class="text-sm">Keahlian & Skill</span>
                </a>

                <!-- Experience -->
                <a href="#pengalaman" class="flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface font-medium transition">
                    <i class="fa-solid fa-briefcase text-sm"></i>
                    <span class="text-sm">Pengalaman Karir</span>
                </a>

                <!-- Statistics -->
                <a href="#statistik" class="flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface font-medium transition">
                    <i class="fa-solid fa-chart-simple text-sm"></i>
                    <span class="text-sm">Statistik & Kunjungan</span>
                </a>

                <!-- Messages with Badge -->
                <a href="#pesan" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface font-medium transition">
                    <div class="flex items-center gap-3.5">
                        <i class="fa-regular fa-comment-dots text-sm"></i>
                        <span class="text-sm">Pesan Masuk</span>
                    </div>
                    @if($totalPesanBaru > 0)
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-brand-dark text-white">{{ $totalPesanBaru }}</span>
                    @endif
                </a>

                <!-- Settings -->
                <a href="#pengaturan" @click.prevent="modalEditProfil = true" class="flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface font-medium transition">
                    <i class="fa-solid fa-gear text-sm"></i>
                    <span class="text-sm">Pengaturan Profil</span>
                </a>
            </nav>
        </div>

        <!-- Logout & External View Bottom Links -->
        <div class="pt-6 border-t border-brand-border space-y-1">
            <a href="{{ route('portfolio.home') }}" target="_blank" class="flex items-center gap-3 px-4 py-2 rounded-xl text-brand-subtext hover:text-brand-dark hover:bg-brand-surface transition font-medium text-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                <span>Lihat Web Portofolio</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-xl text-brand-subtext hover:text-rose-600 hover:bg-rose-50/60 transition font-medium text-xs">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    <span>Keluar (Logout Admin)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ======================================================== -->
    <!-- 2. CENTER WORKSPACE (Expansive Full Width)               -->
    <!-- ======================================================== -->
    <main class="flex-1 bg-[#f8f9fb] p-6 lg:p-8 overflow-y-auto space-y-6">

        <!-- Top Search Bar -->
        <div class="flex items-center justify-between">
            <div class="relative w-full max-w-lg">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-brand-subtext text-xs"></i>
                <input type="text" 
                       x-model="cariProyek" 
                       placeholder="Cari proyek, keahlian, atau pesan..." 
                       class="w-full bg-white border border-brand-border rounded-2xl pl-10 pr-10 py-2.5 text-sm text-brand-dark placeholder-brand-subtext focus:outline-none focus:border-brand-dark focus:ring-1 focus:ring-brand-dark transition shadow-2xs">
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[10px] font-semibold text-brand-subtext px-1.5 py-0.5 bg-brand-surface rounded border border-brand-border">
                    ⌘K
                </div>
            </div>

            <!-- Mobile Quick Action trigger -->
            <div class="lg:hidden flex items-center gap-2">
                <button @click="modalTambahProyek = true" class="px-3.5 py-2 rounded-xl bg-brand-dark text-white text-xs font-semibold flex items-center gap-1.5 shadow-xs">
                    <i class="fa-solid fa-plus text-[10px]"></i> Proyek
                </button>
            </div>
        </div>

        <!-- Greeting Header -->
        <div>
            <p class="text-xs font-semibold text-brand-subtext tracking-wide uppercase">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </p>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-brand-dark tracking-tight mt-1">
                Selamat Datang, {{ $profil->panggilan ?? $profil->nama_lengkap }}!
            </h1>
            <p class="text-xs lg:text-sm text-brand-subtext mt-1 max-w-2xl">
                Kelola seluruh konten portofolio, pantau statistik proyek, dan tanggapi pesan langsung dari calon klien Anda.
            </p>
        </div>

        <!-- Top Widgets Row: Card (Lime) + Chart (White) -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5">

            <!-- A. SIGNATURE LIME CARD -->
            <div class="md:col-span-5 bg-brand-lime rounded-3xl p-6 flex flex-col justify-between shadow-xs relative overflow-hidden group">
                <!-- Top Row -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-brand-dark/10 flex items-center justify-center">
                            <i class="fa-solid fa-award text-brand-dark text-sm"></i>
                        </div>
                        <span class="font-bold text-sm text-brand-dark tracking-tight">Status Portofolio</span>
                    </div>
                    <button class="text-brand-dark/70 hover:text-brand-dark transition text-sm">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>

                <!-- Middle Card Mask Code & Lock indicator -->
                <div class="my-6">
                    <div class="flex items-center gap-2 text-brand-dark/80 text-xs font-mono font-medium tracking-widest">
                        <span>●●●●</span>
                        <span>●●●●</span>
                        <span>{{ date('Y') }}</span>
                        <i class="fa-solid fa-lock text-[11px] ml-1"></i>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-dark/10 text-brand-dark text-xs font-semibold mt-2.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-700 animate-pulse"></span>
                        <span>{{ $profil->status_pekerjaan }}</span>
                    </div>
                </div>

                <!-- Bottom Big Stat Balance -->
                <div>
                    <p class="text-xs text-brand-dark/70 font-medium">Pencapaian Karier</p>
                    <div class="text-2xl lg:text-3xl font-extrabold text-brand-dark tracking-tight mt-0.5">
                        {{ $profil->total_proyek_selesai ?? 25 }} Proyek Selesai
                    </div>
                    <div class="flex items-center justify-between text-xs text-brand-dark/80 mt-2.5 pt-2.5 border-t border-brand-dark/15">
                        <span>Klien Puas: <strong>{{ $profil->total_klien_puas ?? 18 }}+</strong></span>
                        <span>Pengalaman: <strong>{{ $profil->tahun_pengalaman ?? 4 }} Tahun</strong></span>
                    </div>
                </div>
            </div>

            <!-- B. ACTIVITY & FLOW CHART CARD -->
            <div class="md:col-span-7 bg-white rounded-3xl p-6 border border-brand-border shadow-xs flex flex-col justify-between">
                <!-- Header -->
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-brand-dark text-base">Aktivitas Kunjungan</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Chart Pill Toggle -->
                        <div class="inline-flex items-center rounded-xl bg-brand-surface p-1 text-xs font-medium text-brand-subtext border border-brand-border">
                            <span class="px-2.5 py-1 rounded-lg bg-white text-brand-dark shadow-2xs font-semibold">Minggu Ini</span>
                            <span class="px-2.5 py-1 cursor-pointer hover:text-brand-dark">Bulan</span>
                        </div>
                        <button class="text-brand-subtext hover:text-brand-dark text-sm p-1">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                    </div>
                </div>

                <!-- Chart Area: Stylized Line Graph with Lime Accent & Tooltip -->
                <div class="relative py-2">
                    <!-- Tooltip pill -->
                    <div class="absolute left-[45%] top-1 -translate-x-1/2 bg-brand-lime text-brand-dark text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-sm z-10 flex items-center gap-1">
                        <span>259 Kunjungan</span>
                    </div>

                    <!-- SVG Curved Line Chart -->
                    <svg viewBox="0 0 500 140" class="w-full h-32 overflow-visible">
                        <defs>
                            <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#c4f745" stop-opacity="0.35"/>
                                <stop offset="100%" stop-color="#c4f745" stop-opacity="0.0"/>
                            </linearGradient>
                        </defs>
                        <!-- Grid lines -->
                        <line x1="0" y1="20" x2="500" y2="20" stroke="#f1f3f6" stroke-width="1" stroke-dasharray="4"/>
                        <line x1="0" y1="65" x2="500" y2="65" stroke="#f1f3f6" stroke-width="1" stroke-dasharray="4"/>
                        <line x1="0" y1="110" x2="500" y2="110" stroke="#f1f3f6" stroke-width="1" stroke-dasharray="4"/>

                        <!-- Area under curve -->
                        <path d="M 0,110 C 60,110 80,75 140,85 C 180,95 200,30 250,25 C 300,20 340,115 390,95 C 440,75 470,80 500,85 L 500,120 L 0,120 Z" fill="url(#chartGradient)"/>
                        
                        <!-- Main smooth curve -->
                        <path d="M 0,110 C 60,110 80,75 140,85 C 180,95 200,30 250,25 C 300,20 340,115 390,95 C 440,75 470,80 500,85" 
                              fill="none" 
                              stroke="#c4f745" 
                              stroke-width="3" 
                              stroke-linecap="round"/>

                        <!-- Highlight dot with ripple -->
                        <circle cx="250" cy="25" r="5" fill="#1e2025" stroke="#c4f745" stroke-width="3"/>
                    </svg>

                    <!-- Days labels -->
                    <div class="flex justify-between text-[11px] font-medium text-brand-subtext px-2 mt-1">
                        <span>Min</span>
                        <span>Sen</span>
                        <span class="text-brand-dark font-bold">Sel</span>
                        <span>Rab</span>
                        <span>Kam</span>
                        <span>Jum</span>
                        <span>Sab</span>
                    </div>
                </div>

                <!-- Two Dark Mini-Cards underneath -->
                <div class="grid grid-cols-2 gap-3 mt-3 pt-3 border-t border-brand-border">
                    <!-- Mini 1: Pengunjung Portofolio -->
                    <div class="bg-brand-dark rounded-2xl p-3.5 text-white flex items-center justify-between shadow-2xs">
                        <div>
                            <span class="text-[11px] text-white/70 block">Total Pengunjung</span>
                            <span class="text-sm font-bold text-white tracking-tight">+3,425 Org</span>
                        </div>
                        <div class="w-10 h-6 flex items-center justify-end">
                            <i class="fa-solid fa-arrow-trend-up text-brand-lime text-base"></i>
                        </div>
                    </div>

                    <!-- Mini 2: Pesan Masuk -->
                    <div class="bg-brand-dark rounded-2xl p-3.5 text-white flex items-center justify-between shadow-2xs">
                        <div>
                            <span class="text-[11px] text-white/70 block">Pesan Kontak</span>
                            <span class="text-sm font-bold text-white tracking-tight">{{ $pesanList->count() }} Pesan</span>
                        </div>
                        <div class="w-10 h-6 flex items-center justify-end">
                            <i class="fa-regular fa-envelope-open text-brand-lime text-base"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- C. RECENT PROJECTS TABLE -->
        <div id="proyek-section" class="bg-white rounded-3xl p-6 border border-brand-border shadow-xs">
            <!-- Header with Title, Search, and Filter -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                <div>
                    <h2 class="text-lg font-bold text-brand-dark tracking-tight">Daftar Proyek Portofolio</h2>
                    <p class="text-xs text-brand-subtext">Total {{ $totalProyek }} proyek terdaftar di portofolio Anda</p>
                </div>

                <div class="flex items-center gap-2">
                    <!-- Inner Search -->
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-brand-subtext text-xs"></i>
                        <input type="text" 
                               x-model="cariProyek" 
                               placeholder="Cari nama proyek..." 
                               class="bg-brand-surface border border-brand-border rounded-xl pl-8 pr-3 py-1.5 text-xs text-brand-dark focus:outline-none focus:border-brand-dark transition">
                    </div>

                    <!-- Filter Dropdown Button -->
                    <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-brand-border bg-brand-surface text-xs font-semibold text-brand-dark hover:bg-brand-border/50 transition">
                        <span>Filter</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-brand-subtext"></i>
                    </button>

                    <!-- Add Project Button -->
                    <button @click="modalTambahProyek = true" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-brand-dark text-white text-xs font-semibold hover:bg-brand-darkHover transition shadow-xs">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah</span>
                    </button>
                </div>
            </div>

            <!-- Table of Projects -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-brand-border text-[11px] font-semibold text-brand-subtext uppercase tracking-wider">
                            <th class="pb-3 pl-2">Nama Proyek</th>
                            <th class="pb-3">Kategori</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3">Teknologi</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-right pr-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/60 text-sm">
                        @forelse($proyekList as $proyek)
                        <tr class="hover:bg-brand-surface/70 transition group"
                            x-show="cariProyek === '' || '{{ strtolower($proyek->judul) }}'.includes(cariProyek.toLowerCase())">
                            
                            <!-- Proyek Column with Icon Avatar -->
                            <td class="py-3.5 pl-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-brand-surface border border-brand-border flex items-center justify-center text-brand-dark font-bold shrink-0">
                                        <i class="fa-solid fa-laptop-code text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-brand-dark hover:underline cursor-pointer">
                                            {{ $proyek->judul }}
                                        </div>
                                        <div class="text-xs text-brand-subtext">
                                            {{ $proyek->kategori->nama_kategori ?? 'Web Project' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="py-3.5 text-xs text-brand-dark font-medium">
                                <span class="px-2.5 py-1 rounded-lg bg-brand-surface border border-brand-border/80">
                                    {{ $proyek->kategori->nama_kategori ?? 'Aplikasi' }}
                                </span>
                            </td>

                            <!-- Tanggal -->
                            <td class="py-3.5 text-xs text-brand-subtext">
                                {{ \Carbon\Carbon::parse($proyek->tanggal_selesai ?? now())->format('d M, Y') }}
                            </td>

                            <!-- Teknologi -->
                            <td class="py-3.5">
                                <div class="flex flex-wrap gap-1">
                                    @php
                                        $tek = is_array($proyek->teknologi) ? $proyek->teknologi : json_decode($proyek->teknologi ?? '[]', true);
                                    @endphp
                                    @foreach(array_slice($tek ?? ['Laravel', 'Tailwind'], 0, 3) as $t)
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-brand-surface text-brand-dark border border-brand-border">
                                            {{ $t }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            <!-- Status with pill -->
                            <td class="py-3.5">
                                @if($proyek->status == 'dipublikasi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Dipublikasi
                                    </span>
                                @elseif($proyek->status == 'draft')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                        Diarsipkan
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="py-3.5 text-right pr-2">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if(!empty($proyek->url_demo))
                                        <a href="{{ $proyek->url_demo }}" target="_blank" class="p-1.5 text-brand-subtext hover:text-brand-dark rounded-lg hover:bg-brand-surface transition" title="Lihat Demo">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                        </a>
                                    @endif
                                    <button class="p-1.5 text-brand-subtext hover:text-brand-dark rounded-lg hover:bg-brand-surface transition" title="Edit Proyek">
                                        <i class="fa-regular fa-pen-to-square text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-brand-subtext text-xs">
                                Belum ada proyek yang ditambahkan. Klik tombol <strong>+ Tambah</strong> untuk memulai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ======================================================== -->
    <!-- 3. RIGHT PANEL (Full-Height Edge-to-Edge)                 -->
    <!-- ======================================================== -->
    <aside class="w-full lg:w-[330px] bg-white border-t lg:border-t-0 lg:border-l border-brand-border p-6 flex flex-col justify-between shrink-0 overflow-y-auto space-y-6">
        <div class="space-y-6">

            <!-- Top Row Controls -->
            <div class="flex items-center justify-between gap-2">
                <!-- Light / Dark toggle pill -->
                <div class="inline-flex items-center bg-brand-surface border border-brand-border rounded-full p-1 shadow-2xs">
                    <button @click="modeGelap = false" :class="!modeGelap ? 'bg-brand-lime text-brand-dark font-bold' : 'text-brand-subtext'" class="flex items-center gap-1 px-2.5 py-1 rounded-full text-xs transition">
                        <i class="fa-solid fa-sun text-[10px]"></i>
                        <span>Light</span>
                    </button>
                    <button @click="modeGelap = true" :class="modeGelap ? 'bg-brand-dark text-white font-bold' : 'text-brand-subtext'" class="flex items-center gap-1 px-2.5 py-1 rounded-full text-xs transition">
                        <i class="fa-solid fa-moon text-[10px]"></i>
                        <span>Dark</span>
                    </button>
                </div>

                <!-- Settings & Notification Icons -->
                <div class="flex items-center gap-1.5">
                    <button @click="modalEditProfil = true" class="w-8 h-8 rounded-full bg-brand-surface border border-brand-border flex items-center justify-center text-brand-dark hover:border-brand-dark transition shadow-2xs">
                        <i class="fa-solid fa-gear text-xs"></i>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-brand-surface border border-brand-border flex items-center justify-center text-brand-dark hover:border-brand-dark transition relative shadow-2xs">
                        <i class="fa-regular fa-bell text-xs"></i>
                        @if($totalPesanBaru > 0)
                            <span class="w-2 h-2 rounded-full bg-rose-500 absolute top-1.5 right-1.5"></span>
                        @endif
                    </button>
                </div>

                <!-- Primary CTA Button -->
                <button @click="modalTambahProyek = true" class="px-3.5 py-2 rounded-full bg-brand-dark text-white text-xs font-bold hover:bg-brand-darkHover transition shadow-xs whitespace-nowrap">
                    + Proyek
                </button>
            </div>

            <!-- Quick Actions -->
            <div>
                <h3 class="text-sm font-bold text-brand-dark tracking-tight mb-3">Quick Actions</h3>
                <div class="grid grid-cols-4 gap-2.5">
                    <!-- 1. Tambah Proyek -->
                    <button @click="modalTambahProyek = true" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-brand-surface border border-brand-border/80 hover:border-brand-lime hover:bg-white hover:shadow-xs transition group">
                        <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-brand-dark group-hover:bg-brand-lime transition mb-1 border border-brand-border">
                            <i class="fa-solid fa-arrow-up text-xs"></i>
                        </div>
                        <span class="text-[11px] font-semibold text-brand-dark">Proyek</span>
                    </button>

                    <!-- 2. Edit Profil -->
                    <button @click="modalEditProfil = true" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-brand-surface border border-brand-border/80 hover:border-brand-lime hover:bg-white hover:shadow-xs transition group">
                        <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-brand-dark group-hover:bg-brand-lime transition mb-1 border border-brand-border">
                            <i class="fa-solid fa-arrow-down text-xs"></i>
                        </div>
                        <span class="text-[11px] font-semibold text-brand-dark">Profil</span>
                    </button>

                    <!-- 3. Keahlian -->
                    <a href="#keahlian" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-brand-surface border border-brand-border/80 hover:border-brand-lime hover:bg-white hover:shadow-xs transition group">
                        <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-brand-dark group-hover:bg-brand-lime transition mb-1 border border-brand-border">
                            <i class="fa-solid fa-code text-xs"></i>
                        </div>
                        <span class="text-[11px] font-semibold text-brand-dark">Skill</span>
                    </a>

                    <!-- 4. Lihat Web -->
                    <a href="{{ route('portfolio.home') }}" target="_blank" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-brand-surface border border-brand-border/80 hover:border-brand-lime hover:bg-white hover:shadow-xs transition group">
                        <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-brand-dark group-hover:bg-brand-lime transition mb-1 border border-brand-border">
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        </div>
                        <span class="text-[11px] font-semibold text-brand-dark">Web</span>
                    </a>
                </div>
            </div>

            <!-- Notifications & Recent Messages -->
            <div>
                <div class="flex items-center justify-between mb-2.5">
                    <h3 class="text-sm font-bold text-brand-dark tracking-tight">Notification</h3>
                    <button class="text-brand-subtext hover:text-brand-dark text-xs">
                        <i class="fa-solid fa-sliders"></i>
                    </button>
                </div>

                <!-- Tabs: All, Following, Archive -->
                <div class="flex items-center gap-2 border-b border-brand-border pb-2 mb-3">
                    <button @click="tabNotifikasi = 'semua'" :class="tabNotifikasi === 'semua' ? 'text-brand-dark font-bold' : 'text-brand-subtext'" class="text-xs flex items-center gap-1.5 transition">
                        <span>All</span>
                        <span class="text-[10px] font-bold px-1.5 rounded-full bg-brand-dark text-white">7</span>
                    </button>
                    <button @click="tabNotifikasi = 'baru'" :class="tabNotifikasi === 'baru' ? 'text-brand-dark font-bold' : 'text-brand-subtext'" class="text-xs flex items-center gap-1.5 transition ml-2">
                        <span>Pesan</span>
                        <span class="text-[10px] font-bold px-1.5 rounded-full bg-brand-border text-brand-dark">{{ $totalPesanBaru }}</span>
                    </button>
                    <button @click="tabNotifikasi = 'arsip'" :class="tabNotifikasi === 'arsip' ? 'text-brand-dark font-bold' : 'text-brand-subtext'" class="text-xs transition ml-2">
                        <span>Archive</span>
                    </button>
                </div>

                <!-- Notification List Items -->
                <div class="space-y-3">
                    <!-- Item 1: System update -->
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-brand-surface border border-brand-border flex items-center justify-center text-brand-dark shrink-0 mt-0.5">
                            <i class="fa-solid fa-key text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-brand-dark">Profil Diperbarui</p>
                                <span class="text-[10px] text-brand-subtext">Baru saja</span>
                            </div>
                            <p class="text-[11px] text-brand-subtext truncate">Data portofolio tersimpan di database</p>
                        </div>
                    </div>

                    <!-- Item 2: New Message with Action Buttons -->
                    @if($pesanList->isNotEmpty())
                        @php $firstPesan = $pesanList->first(); @endphp
                        <div class="bg-brand-surface p-3.5 rounded-2xl border border-brand-border shadow-2xs space-y-2">
                            <div class="flex items-start gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-brand-lime flex items-center justify-center text-brand-dark shrink-0">
                                    <i class="fa-regular fa-comment text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-xs font-bold text-brand-dark truncate">{{ $firstPesan->nama_pengirim }}</p>
                                        <span class="text-[10px] text-brand-subtext">4j lalu</span>
                                    </div>
                                    <p class="text-[11px] text-brand-subtext line-clamp-1">{{ $firstPesan->subjek }}</p>
                                </div>
                            </div>

                            <!-- Buttons: Balas (Lime) and Nanti (White) -->
                            <div class="flex items-center gap-2 pt-1">
                                <a href="mailto:{{ $firstPesan->email_pengirim ?? 'klien@example.com' }}" class="px-3 py-1 rounded-lg bg-brand-lime text-brand-dark text-[11px] font-bold hover:bg-brand-limeHover transition">
                                    Balas Email
                                </a>
                                <button class="px-3 py-1 rounded-lg bg-white text-brand-dark text-[11px] font-semibold border border-brand-border hover:bg-brand-border/40 transition">
                                    Nanti
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Item 3: File / CV update -->
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-brand-surface border border-brand-border flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                            <i class="fa-regular fa-file-pdf text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-brand-dark">Dokumen Resume / CV</p>
                                <span class="text-[10px] text-brand-subtext">1 hari lalu</span>
                            </div>
                            <p class="text-[10px] text-brand-subtext font-mono">cv_fuad_bandhu_2026.pdf (1.8 MB)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Banner Card -->
        <div class="bg-brand-dark rounded-3xl p-5 text-white relative overflow-hidden shadow-xs">
            <div class="relative z-10 max-w-[65%] space-y-2">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-brand-lime">Live Preview</span>
                <h4 class="text-base font-extrabold leading-snug tracking-tight">
                    Lihat Website Portofolio
                </h4>
                <p class="text-[11px] text-white/70 leading-relaxed">
                    Tinjau tampilan publik yang dilihat oleh pengunjung dan klien.
                </p>
                <div class="pt-1">
                    <a href="{{ route('portfolio.home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-brand-lime text-brand-dark text-xs font-bold hover:bg-brand-limeHover transition shadow-xs">
                        <span>Buka Website</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>
            </div>

            <div class="absolute right-0 bottom-0 w-28 h-28 pointer-events-none opacity-85">
                <div class="w-full h-full rounded-tl-full bg-brand-lime/10 flex items-center justify-center">
                    <i class="fa-solid fa-rocket text-4xl text-brand-lime/80 translate-x-2 translate-y-2"></i>
                </div>
            </div>
        </div>
    </aside>

    <!-- ======================================================== -->
    <!-- MODAL TAMBAH PROYEK (Form CMS Cepat)                     -->
    <!-- ======================================================== -->
    <div x-show="modalTambahProyek" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-brand-dark/40 backdrop-blur-xs">
        
        <div @click.away="modalTambahProyek = false" class="bg-white rounded-3xl w-full max-w-lg p-6 shadow-2xl border border-brand-border space-y-4">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-brand-lime"></span>
                    <h3 class="font-bold text-brand-dark text-base">Tambah Proyek Baru</h3>
                </div>
                <button @click="modalTambahProyek = false" class="text-brand-subtext hover:text-brand-dark text-sm">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.proyek.simpan') }}" method="POST" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-brand-dark mb-1">Judul Proyek</label>
                    <input type="text" name="judul" required placeholder="Contoh: Fintech SaaS Dashboard" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">Kategori</label>
                        <select name="kategori_id" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                            <option value="">Pilih Kategori...</option>
                            @foreach($kategoriList as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">Status Publikasi</label>
                        <select name="status" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                            <option value="dipublikasi">Dipublikasi</option>
                            <option value="draft">Draft</option>
                            <option value="diarsipkan">Diarsipkan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-brand-dark mb-1">Ringkasan Singkat</label>
                    <textarea name="ringkasan" rows="2" placeholder="Deskripsi 1-2 kalimat untuk kartu portofolio..." class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-brand-dark mb-1">Teknologi Digunakan (Pisahkan Koma)</label>
                    <input type="text" name="teknologi" placeholder="Contoh: Laravel, TailwindCSS, Vue.js, MySQL" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">URL Demo</label>
                        <input type="url" name="url_demo" placeholder="https://..." class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">URL GitHub / Repositori</label>
                        <input type="url" name="url_repositori" placeholder="https://github.com/..." class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="apakah_unggulan" id="apakah_unggulan" value="1" checked class="rounded border-brand-border text-brand-dark focus:ring-brand-lime">
                    <label for="apakah_unggulan" class="text-xs font-medium text-brand-dark cursor-pointer">Tampilkan sebagai proyek unggulan di halaman utama</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button type="button" @click="modalTambahProyek = false" class="px-4 py-2 rounded-xl bg-brand-surface text-brand-dark text-xs font-semibold hover:bg-brand-border transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-brand-dark text-white text-xs font-bold hover:bg-brand-darkHover transition shadow-xs">
                        Simpan ke Portofolio
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL EDIT PROFIL                                        -->
    <!-- ======================================================== -->
    <div x-show="modalEditProfil" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-brand-dark/40 backdrop-blur-xs">
        
        <div @click.away="modalEditProfil = false" class="bg-white rounded-3xl w-full max-w-lg p-6 shadow-2xl border border-brand-border space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-brand-lime"></span>
                    <h3 class="font-bold text-brand-dark text-base">Edit Informasi Profil CMS</h3>
                </div>
                <button @click="modalEditProfil = false" class="text-brand-subtext hover:text-brand-dark text-sm">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ $profil->nama_lengkap }}" required class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">Nama Panggilan</label>
                        <input type="text" name="panggilan" value="{{ $profil->panggilan }}" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-brand-dark mb-1">Gelar / Jabatan Utama</label>
                    <input type="text" name="jabatan" value="{{ $profil->jabatan }}" required class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-brand-dark mb-1">Status Ketersediaan</label>
                    <input type="text" name="status_pekerjaan" value="{{ $profil->status_pekerjaan }}" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">Email Kontak</label>
                        <input type="email" name="email" value="{{ $profil->email }}" required class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-brand-dark mb-1">Kota & Negara</label>
                        <input type="text" name="kota" value="{{ $profil->kota }}, {{ $profil->negara }}" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-brand-dark mb-1">Ringkasan Bio (Hero)</label>
                    <textarea name="ringkasan_tentang" rows="3" class="w-full text-sm bg-brand-surface border border-brand-border rounded-xl px-3.5 py-2 text-brand-dark focus:border-brand-dark focus:outline-none">{{ $profil->ringkasan_tentang }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button type="button" @click="modalEditProfil = false" class="px-4 py-2 rounded-xl bg-brand-surface text-brand-dark text-xs font-semibold hover:bg-brand-border transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-brand-dark text-white text-xs font-bold hover:bg-brand-darkHover transition shadow-xs">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
