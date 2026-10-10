@extends('layouts.app2')

@section('title', 'FitMySkin - Masuk atau Daftar')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 my-auto">
    <!-- Outer Card Container -->
    <div class="bg-white rounded-3xl shadow-xl border border-rose-100 overflow-hidden max-w-4xl w-full grid grid-cols-1 md:grid-cols-2">

        <!-- KIRI: BANNER BRAND / PROMO -->
        <div class="bg-gradient-to-br from-rose-100 via-rose-50 to-pink-100 p-8 flex flex-col justify-between relative overflow-hidden">
            <!-- Badge Brand -->
            <div class="flex items-center gap-2">
                <div class="bg-white/80 backdrop-blur-xs px-3.5 py-1.5 rounded-full shadow-2xs flex items-center gap-2 border border-rose-200/50">
                    <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                    <span class="font-bold text-neutral-800 text-sm">FitMySkin ✨</span>
                </div>
            </div>

            <!-- Content Middle -->
            <div class="my-8">
                <span class="bg-rose-200/60 text-rose-700 text-[11px] font-bold tracking-wider px-3 py-1 rounded-full uppercase inline-block mb-3">
                    Skin Journal & Habit Tracker
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 leading-tight mb-3">
                    Ritual Cantik,<br>
                    <span class="text-rose-600">Kulit Sehat</span> Terawat.
                </h1>
                <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">
                    Catat perjalanan kulitmu setiap hari, temukan rutinitas paling pas, dan nikmati kilau alami tanpa rasa khawatir.
                </p>

                <!-- Product Preview Image -->
                <div class="mt-6 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                    <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=500&auto=format&fit=crop&q=80" alt="Skincare Products" class="w-full h-44 object-cover transform group-hover:scale-105 transition duration-500">
                    <div class="absolute bottom-2 right-2 bg-white/90 backdrop-blur-xs text-[11px] font-semibold text-emerald-600 px-2.5 py-1 rounded-lg border border-emerald-100">
                        💧 Hydration +86%
                    </div>
                </div>
            </div>

            <!-- Bottom Testimonial -->
            <div class="bg-white/80 backdrop-blur-xs p-3.5 rounded-2xl border border-rose-100 text-xs shadow-2xs">
                <div class="flex items-center gap-1 text-amber-400 mb-1">
                    ★★★★★
                </div>
                <p class="text-neutral-700 italic text-[11px] mb-2">
                    "Sejak pakai FitMySkin, skin barrier aku pulih dan gak pernah salah beli skincare lagi! 💖"
                </p>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-rose-400 text-white flex items-center justify-center font-bold text-[10px]">M</div>
                    <span class="font-semibold text-neutral-800 text-[11px]">Maya, <span class="text-neutral-400 font-normal">FitMySkin Member (Jakarta)</span></span>
                </div>
            </div>
        </div>

        <!-- KANAN: FORM LOGIN & REGISTER -->
        <div class="p-8 flex flex-col justify-between">
            <div>
                <!-- Header Title -->
                <div class="text-center md:text-left mb-6">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-rose-500 bg-rose-50 px-2.5 py-1 rounded-md inline-block mb-1">
                        FITMYSKIN MEMBER SPACE 🪄
                    </span>
                    <h2 class="text-2xl font-bold text-neutral-900">
                        Hai Cantik, Selamat Datang! 🌸
                    </h2>
                    <p class="text-xs text-neutral-500 mt-1">
                        Masuk ke akunmu untuk melanjutkan ritual jurnal kulit hari ini.
                    </p>
                </div>

                <!-- Mode Switcher (Tab Button) -->
                <div class="bg-neutral-100 p-1 rounded-xl flex text-xs font-semibold mb-6">
                    <button id="tab-login" onclick="switchMode('login')" class="flex-1 py-2 rounded-lg transition-all duration-200 bg-white text-neutral-800 shadow-2xs text-center">
                        Masuk (Login)
                    </button>
                    <button id="tab-register" onclick="switchMode('register')" class="flex-1 py-2 rounded-lg transition-all duration-200 text-rose-500 hover:text-neutral-800 text-center">
                        Daftar Akun Baru
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('dashboard') }}" method="GET" class="space-y-4">
                    <!-- Nama Lengkap (Khusus Mode Register) -->
                    <div id="field-nama" class="hidden">
                        <div class="flex justify-between items-center mb-1">
                            <label class="text-xs font-bold text-neutral-700">Nama Lengkap</label>
                            <span class="text-[10px] text-rose-500 font-semibold">wajib</span>
                        </div>
                        <input type="text" placeholder="nama lengkap kamu" class="w-full text-xs px-3.5 py-2.5 rounded-xl bg-neutral-100 border border-neutral-200 focus:outline-none focus:border-rose-400 transition">
                    </div>

                    <!-- Email -->
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="text-xs font-bold text-neutral-700">Alamat Email</label>
                            <span class="text-[10px] text-rose-500 font-semibold">wajib</span>
                        </div>
                        <input type="email" placeholder="nama.kamu@email.com" class="w-full text-xs px-3.5 py-2.5 rounded-xl bg-neutral-100 border border-neutral-200 focus:outline-none focus:border-rose-400 transition" required>
                    </div>

                    <!-- Kata Sandi -->
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="text-xs font-bold text-neutral-700">Kata Sandi / Password</label>
                            <span class="text-[10px] text-neutral-400">Min. 8 karakter</span>
                        </div>
                        <input type="password" placeholder="••••••••" class="w-full text-xs px-3.5 py-2.5 rounded-xl bg-neutral-100 border border-neutral-200 focus:outline-none focus:border-rose-400 transition" required>
                    </div>

                    <!-- Remember Me / Terms -->
                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="flex items-center gap-2 cursor-pointer text-neutral-600">
                            <input type="checkbox" class="rounded text-rose-500 focus:ring-rose-400 border-neutral-300">
                            <span>Ingat Saya</span>
                        </label>
                        <a href="#" class="text-rose-500 font-medium hover:underline text-[11px]">Lupa sandi?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="btn-submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs py-3 rounded-xl shadow-md hover:shadow-lg transition transform active:scale-[0.99] mt-2">
                        Masuk Sekarang ✨
                    </button>
                </form>

                <!-- Separator -->
                <div class="relative my-5 text-center">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-neutral-200"></div></div>
                    <span class="relative bg-white px-3 text-[10px] uppercase font-bold text-neutral-400">Atau Masuk Dengan Google</span>
                </div>

                <!-- Google Button -->
                <button type="button" class="w-full bg-neutral-100 hover:bg-neutral-200 text-neutral-700 text-xs font-bold py-2.5 rounded-xl flex items-center justify-center gap-2 transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                    Lanjutkan dengan Google
                </button>
            </div>

            <!-- Footer Security Note -->
            <div class="mt-6 pt-4 border-t border-neutral-100 text-[11px] text-neutral-400 text-center flex items-center justify-center gap-1.5">
                <span class="text-emerald-500">🛡️</span>
                <span>Data jurnal dan foto kulitmu <strong class="text-emerald-600">100% aman</strong> dan terenkripsi secara privat di Glowie Cloud.</span>
            </div>
        </div>

    </div>
</div>

<!-- Javascript Toggle Login / Register -->
<script>
    function switchMode(mode) {
        const fieldNama = document.getElementById('field-nama');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        const btnSubmit = document.getElementById('btn-submit');

        if (mode === 'register') {
            fieldNama.classList.remove('hidden');
            tabRegister.className = "flex-1 py-2 rounded-lg transition-all duration-200 bg-white text-rose-500 shadow-2xs font-bold text-center";
            tabLogin.className = "flex-1 py-2 rounded-lg transition-all duration-200 text-neutral-500 hover:text-neutral-800 text-center";
            btnSubmit.innerText = "Daftar Sekarang 💖";
        } else {
            fieldNama.classList.add('hidden');
            tabLogin.className = "flex-1 py-2 rounded-lg transition-all duration-200 bg-white text-neutral-800 shadow-2xs font-bold text-center";
            tabRegister.className = "flex-1 py-2 rounded-lg transition-all duration-200 text-rose-500 hover:text-neutral-800 text-center";
            btnSubmit.innerText = "Masuk Sekarang ✨";
        }
    }
</script>
@endsection
