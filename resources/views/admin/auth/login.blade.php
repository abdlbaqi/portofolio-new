<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — PortoCMS</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN with Custom Palette -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            lime: '#c4f745',
                            limeHover: '#b3e835',
                            limeSoft: '#f0fcd6',
                            dark: '#1e2025',
                            darkHover: '#2a2d34',
                            surface: '#f8f9fb',
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #1e2025;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="min-h-screen bg-white flex flex-col justify-between p-4 sm:p-6 lg:p-8">

    <!-- Top Bar: Logo & Back Link -->
    <header class="w-full max-w-6xl mx-auto flex items-center justify-between py-2">
        <a href="{{ route('portfolio.home') }}" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-full bg-brand-dark flex items-center justify-center relative shadow-xs">
                <span class="w-3.5 h-3.5 rounded-full bg-brand-lime absolute -top-0.5 -right-0.5"></span>
                <i class="fa-solid fa-code text-white text-sm"></i>
            </div>
            <span class="text-xl font-bold tracking-tight text-brand-dark">Porto<span class="text-brand-dark">Talk</span></span>
        </a>

        <a href="{{ route('portfolio.home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-brand-subtext hover:text-brand-dark transition">
            <i class="fa-solid fa-arrow-left text-[11px]"></i>
            <span>Kembali ke Website</span>
        </a>
    </header>

    <!-- Main Login Card Area -->
    <main class="w-full max-w-md mx-auto my-auto py-8" x-data="{ 
        lihatPassword: false,
        email: '{{ old('email', 'admin@portofolio.test') }}',
        password: 'password123',
        isiOtomatis() {
            this.email = 'admin@portofolio.test';
            this.password = 'password123';
        }
    }">
        <div class="bg-white rounded-3xl p-7 sm:p-9 border border-brand-border shadow-[0_20px_50px_-15px_rgba(0,0,0,0.06)] space-y-6">
            
            <!-- Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface text-brand-dark text-xs font-semibold border border-brand-border mb-1">
                    <span class="w-2 h-2 rounded-full bg-brand-lime"></span>
                    <span>Otentikasi Administrator</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight">
                    Masuk ke Panel CMS
                </h1>
                <p class="text-xs sm:text-sm text-brand-subtext">
                    Kelola data proyek, keahlian, profil, dan pantau pesan masuk.
                </p>
            </div>

            <!-- Flash Alerts -->
            @if(session('pesan'))
                <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border text-xs text-brand-dark font-medium flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-blue-500"></i>
                    <span>{{ session('pesan') }}</span>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-xs text-rose-700 font-medium space-y-1">
                    <div class="flex items-center gap-1.5 font-bold">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Gagal Masuk</span>
                    </div>
                    @foreach($errors->all() as $error)
                        <p class="pl-4">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Quick Demo Credentials Helper Card -->
            <div class="bg-brand-surface p-3.5 rounded-2xl border border-brand-border/80 flex items-center justify-between gap-3 text-xs">
                <div>
                    <span class="font-bold text-brand-dark block text-[11px] uppercase tracking-wider">Akun Admin Default:</span>
                    <span class="text-brand-subtext font-mono text-[11px]">admin@portofolio.test / password123</span>
                </div>
                <button type="button" @click="isiOtomatis()" class="px-2.5 py-1 rounded-lg bg-brand-lime text-brand-dark font-bold text-[11px] hover:bg-brand-limeHover transition shrink-0 shadow-2xs">
                    Isi Otomatis
                </button>
            </div>

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-brand-dark mb-1.5">Email Administrator</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-brand-subtext text-xs"></i>
                        <input type="email" 
                               name="email" 
                               x-model="email" 
                               required 
                               placeholder="admin@portofolio.test" 
                               class="w-full bg-[#fbfbfc] border border-brand-border rounded-xl pl-10 pr-4 py-2.5 text-sm text-brand-dark placeholder-brand-subtext focus:outline-none focus:border-brand-dark focus:bg-white transition shadow-2xs">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-brand-dark">Kata Sandi</label>
                        <button type="button" @click="lihatPassword = !lihatPassword" class="text-[11px] font-semibold text-brand-subtext hover:text-brand-dark transition">
                            <span x-text="lihatPassword ? 'Sembunyikan' : 'Tampilkan'"></span>
                        </button>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-brand-subtext text-xs"></i>
                        <input :type="lihatPassword ? 'text' : 'password'" 
                               name="password" 
                               x-model="password" 
                               required 
                               placeholder="••••••••••••" 
                               class="w-full bg-[#fbfbfc] border border-brand-border rounded-xl pl-10 pr-10 py-2.5 text-sm text-brand-dark placeholder-brand-subtext focus:outline-none focus:border-brand-dark focus:bg-white transition shadow-2xs font-mono">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-medium text-brand-dark">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-brand-border text-brand-dark focus:ring-brand-lime">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button matching the dark charcoal + lime highlight -->
                <button type="submit" class="w-full py-3 rounded-xl bg-brand-dark text-white text-sm font-bold hover:bg-brand-darkHover transition shadow-sm flex items-center justify-center gap-2 group mt-2">
                    <span>Masuk ke Panel CMS</span>
                    <i class="fa-solid fa-arrow-right text-xs text-brand-lime group-hover:translate-x-1 transition"></i>
                </button>
            </form>

        </div>
    </main>

    <!-- Footer Note -->
    <footer class="w-full max-w-6xl mx-auto text-center py-4 text-xs text-brand-subtext">
        <span>© {{ date('Y') }} PortoTalk CMS. Seluruh hak cipta dilindungi.</span>
    </footer>

</body>
</html>
