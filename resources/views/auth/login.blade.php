<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staf IJCS</title>

    {{-- Assets bundling dari Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-4 font-sans antialiased text-gray-900">

    <div class="w-full max-w-sm sm:max-w-md">
        
        <!-- CARD LOGIN -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-200/80 shadow-sm">
            
            <!-- HEADER CARD -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-gray-900 text-center">Login Staf IJCS</h1>
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
                    <ul class="list-disc list-inside">
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

                <!-- KATA SANDI (TANPA TOMBOL LUPA SANDI) -->
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
                    <p x-show="captchaError" class="text-[11px] text-rose-600 font-medium mt-1">
                        *Kode captcha tidak sesuai, silakan coba lagi.
                    </p>
                </div>

                <!-- SUBMIT -->
                <button 
                    type="submit" 
                    :disabled="loading"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-4 rounded-xl text-xs sm:text-sm transition flex items-center justify-center space-x-2 shadow-sm disabled:opacity-75"
                >
                    <template x-if="!loading">
                        < class="flex items-center gap-2">
                            <span>LOGIN</span>
                            
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