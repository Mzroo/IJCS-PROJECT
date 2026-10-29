<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staf IJCS</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Assets bundling dari Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-full flex items-center justify-center p-4 sm:p-6 font-sans antialiased text-gray-900 bg-slate-100 relative overflow-x-hidden">

    <!-- BACKGROUND DOODLE WATERMARK SOFT (WARNA ABUS-ABU SOFT / SKY) -->
    <div class="fixed inset-0 pointer-events-none z-0 opacity-20 flex flex-wrap justify-between p-8 text-sky-600 select-none overflow-hidden">
        <i class="fa-solid fa-screwdriver-wrench text-6xl absolute top-10 left-10 rotate-12"></i>
        <i class="fa-solid fa-microchip text-7xl absolute top-1/4 right-16 -rotate-12"></i>
        <i class="fa-solid fa-laptop text-8xl absolute bottom-12 left-16 -rotate-6"></i>
        <i class="fa-solid fa-gear text-7xl absolute bottom-1/3 right-1/4 rotate-45"></i>
        <i class="fa-solid fa-plug text-5xl absolute top-12 right-1/3 rotate-12"></i>
        <i class="fa-solid fa-hard-drive text-6xl absolute bottom-10 right-10 -rotate-12"></i>
        <i class="fa-solid fa-bug text-5xl absolute top-1/2 left-12 rotate-90"></i>
        <i class="fa-solid fa-code text-6xl absolute top-1/3 left-1/3 -rotate-12"></i>
        <i class="fa-solid fa-desktop text-7xl absolute bottom-1/4 left-1/4 rotate-12"></i>
    </div>

    <!-- SOFT GLOW LIGHT EFFECT BEHIND CARD -->
    <div class="absolute w-[30rem] h-[30rem] bg-sky-300/30 rounded-full blur-3xl pointer-events-none z-0"></div>

    <!-- MAIN CONTAINER CARD SPLIT -->
    <div class="w-full max-w-4xl bg-white rounded-3xl border border-gray-200/80 shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 relative z-10">
        
        <!-- KOLOM KIRI: GAMBAR MASKOT & BRANDING (Hanya tampil di Tablet/Desktop) -->
        <div class="hidden md:flex flex-col justify-between p-8 bg-gradient-to-br from-slate-900 via-slate-800 to-sky-950 text-white relative overflow-hidden">
            
            <!-- Branding Logo Header -->
            <div class="relative z-10 flex items-center space-x-3">
                <div class="bg-sky-500 text-white p-2.5 rounded-2xl shadow-lg shadow-sky-500/30">
                    <i class="fa-solid fa-laptop-code text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-xl tracking-wider leading-none">IJCS <span class="text-sky-400 text-xs font-semibold">SYSTEM</span></h2>
                    <p class="text-[10px] text-slate-400 font-medium">Indra Jaya Computer Service</p>
                </div>
            </div>

            <!-- Gambar Maskot Teknisi IJCS -->
            <div class="relative z-10 my-4 flex justify-center items-center">
                <img 
                    src="{{ asset('assets/img/login-img.png') }}" 
                    alt="IJCS Technician Repair Mascot" 
                    class="max-h-[340px] w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300"
                >
            </div>

            <!-- Footer Quote / Note -->
            <div class="relative z-10 bg-white/10 backdrop-blur-md border border-white/10 p-4 rounded-2xl text-xs text-slate-300">
                <p class="font-semibold text-white mb-0.5">Sistem Internal Staf & Teknisi</p>
                <p class="text-[11px] text-slate-400 leading-relaxed">Kelola servisan, inventaris sparepart, dan rekap transaksi dengan cepat dan presisi.</p>
            </div>

            <!-- Pattern Dekorasif Background Card Kiri -->
            <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -top-16 -right-16 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <!-- KOLOM KANAN: FORM LOGIN -->
        <div class="p-6 sm:p-10 flex flex-col justify-center bg-white">
            
            <!-- HEADER CARD (Versi Mobile ada Logo) -->
            <div class="mb-6">
                <div class="flex items-center space-x-2.5 mb-3 md:hidden">
                    <div class="bg-sky-600 text-white p-2 rounded-xl text-xs">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <span class="font-black text-base tracking-wider text-gray-900">IJCS <span class="text-sky-600 text-xs">ADMIN</span></span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-gray-900">Login Staf IJCS</h1>
                <p class="text-xs text-gray-500 mt-1">Masukkan kredensial akun untuk mengakses sistem</p>
            </div>

            <!-- ALERT ERROR -->
            @if (session('status'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl font-medium">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM LOGIN + CAPTCHA -->
            <form 
                method="POST" 
                action="/login" 
                class="space-y-4" 
                x-data="{
                    showPassword: false,
                    loading: false,
                    captchaCode: '',
                    userCaptcha: '',
                    captchaError: false,
                    generateCaptcha() {
                        const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                        let result = '';
                        for (let i = 0; i < 4; i++) {
                            result += chars.charAt(Math.floor(Math.random() * chars.length));
                        }
                        this.captchaCode = result;
                    },
                    submitForm(e) {
                        if (this.userCaptcha.toUpperCase() !== this.captchaCode) {
                            e.preventDefault();
                            this.captchaError = true;
                            this.userCaptcha = '';
                            this.generateCaptcha();
                        } else {
                            this.captchaError = false;
                            this.loading = true;
                        }
                    }
                }"
                x-init="generateCaptcha()"
                @submit="submitForm($event)"
            >
                @csrf

                <!-- EMAIL / USERNAME -->
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Email / Username
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            placeholder="nama@ijcs.com"
                            class="w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                        >
                    </div>
                </div>

                <!-- KATA SANDI -->
                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input 
                            :type="showPassword ? 'text' : 'password'" 
                            name="password" 
                            id="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full pl-9 pr-9 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                        >
                        <button 
                            type="button" 
                            @click="showPassword = !showPassword" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                        >
                            <i class="fa-solid text-xs" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- CAPTCHA -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">
                        Verifikasi Keamanan
                    </label>
                    
                    <div class="flex items-center gap-2 mb-2">
                        <!-- BOX CAPTCHA SOFT ABU-ABU -->
                        <div class="bg-slate-100 text-slate-800 px-4 py-2 rounded-xl text-base font-mono font-black tracking-widest select-none flex items-center justify-center border border-slate-200 w-28 shrink-0 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/5 to-transparent skew-x-12"></div>
                            <span x-text="captchaCode"></span>
                        </div>

                        <!-- REFRESH CAPTCHA -->
                        <button 
                            type="button" 
                            @click="generateCaptcha()" 
                            class="p-2.5 text-gray-500 hover:text-sky-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition text-xs flex items-center justify-center"
                            title="Acak Ulang Kode"
                        >
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </button>

                        <span class="text-[11px] text-gray-400 leading-tight">Masukkan kode 4 karakter</span>
                    </div>

                    <!-- INPUT CAPTCHA -->
                    <input 
                        type="text" 
                        x-model="userCaptcha"
                        required 
                        maxlength="4"
                        placeholder="Ketik kode di atas"
                        class="w-full px-3 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 uppercase font-mono tracking-wider focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                    
                    <!-- ERROR CAPTCHA -->
                    <p x-show="captchaError" class="text-[11px] text-rose-600 font-medium mt-1" x-cloak>
                        *Kode captcha tidak sesuai, silakan coba lagi.
                    </p>
                </div>

                <!-- SUBMIT BUTTON -->
                <button 
                    type="submit" 
                    :disabled="loading"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-4 rounded-xl text-xs sm:text-sm transition flex items-center justify-center space-x-2 shadow-md shadow-sky-600/20 disabled:opacity-75"
                >
                    <template x-if="!loading">
                        <div class="flex items-center gap-2">
                            <span>LOGIN KEDALAM SISTEM</span>
                        </div>
                    </template>
                    <template x-if="loading">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-notch fa-spin text-xs"></i>
                            <span>Memproses...</span>
                        </div>
                    </template>
                </button>
            </form>

        </div>

    </div>

</body>
</html>