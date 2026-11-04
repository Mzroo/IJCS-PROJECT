<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | IJCS</title>
    
    <!-- BUNDLE VITE PROYEK -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center p-4 font-sans relative overflow-hidden">

    <!-- Latar Belakang Ambient Glow & Pola Titik -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-md w-full text-center space-y-6 z-10">
        
        <!-- VISUAL ERROR 404 & IKON TOOL / SERVIS -->
        <div class="relative inline-block">
            <!-- Teks 404 Besar Latar Belakang -->
            <span class="text-8xl sm:text-9xl font-black text-white/10 select-none tracking-tighter">
                404
            </span>
            
            <!-- Ikon Floating di Tengah -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-sky-500/40 border border-white/20 animate-bounce">
                    <i class="fa-solid fa-triangle-exclamation text-2xl sm:text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- PESAN KETERANGAN -->
        <div class="space-y-2">
            <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-xs sm:text-sm text-sky-100/70 max-w-xs mx-auto leading-relaxed">
                Waduh, alamat yang kamu tuju tidak ada atau tiket perbaikan yang kamu cari sudah dihapus/berubah URL-nya.
            </p>
        </div>

        <!-- CARD NAVIGASI / AKSI KEMBALI -->
        <div class="bg-white/10 backdrop-blur-xl p-4 sm:p-5 rounded-3xl border border-white/15 space-y-3 shadow-2xl">
            <a 
                href="{{ route('public.home') }}" 
                class="w-full bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white font-black py-3 px-6 rounded-2xl text-xs sm:text-sm transition shadow-lg hover:shadow-sky-500/30 flex items-center justify-center gap-2 active:scale-95 cursor-pointer"
            >
                <i class="fa-solid fa-house text-xs"></i>
                <span>Kembali ke Halaman Utama</span>
            </a>

            <a 
                href="{{ route('public.home') }}#tracking" 
                class="w-full bg-white/10 hover:bg-white/20 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition border border-white/20 flex items-center justify-center gap-2 block"
            >
                <i class="fa-solid fa-magnifying-glass text-xs text-sky-400"></i>
                <span>Cek Nomor Nota Servis</span>
            </a>
        </div>

        <!-- FOOTER BANTUAN -->
        <div class="pt-2 text-[11px] text-slate-400">
            <span>Butuh bantuan staf IJCS? </span>
            <a href="https://wa.me/6281234567890" target="_blank" class="text-emerald-400 font-bold hover:underline inline-flex items-center gap-1">
                <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
            </a>
        </div>

    </div>

</body>
</html>