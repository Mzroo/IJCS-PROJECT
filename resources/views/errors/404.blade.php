<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | IJCS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center p-5 font-sans relative overflow-hidden">

    <!-- Latar Belakang Ambient Glow & Pola Titik -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <!-- ELEMEN DOODLE GEOMETRIS DI BACKGROUND -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden opacity-20">
        <!-- Doodle Baut & Obeng (Kiri Atas) -->
        <svg class="absolute top-10 left-10 w-16 h-16 text-sky-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>

        <!-- Doodle Microchip / PCB (Kanan Atas) -->
        <svg class="absolute top-16 right-12 w-20 h-20 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9 3v2m6-2v2M9 19v2m6-2v2M3 9h2m-2 6h2m14-6h2m-2 6h2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
        </svg>

        <!-- Doodle Sinyal / Wifi (Kiri Bawah) -->
        <svg class="absolute bottom-20 left-16 w-14 h-14 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a10 10 0 0114.142 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
        </svg>

        <!-- Doodle Wrench / Kunci Pas (Kanan Bawah) -->
        <svg class="absolute bottom-12 right-20 w-16 h-16 text-indigo-400 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
        </svg>
    </div>

    <!-- MAIN CONTAINER -->
    <main class="relative z-10 w-full max-w-4xl mx-auto text-center space-y-8">

        <!-- KONTEN UTAMA: LAYOUT 2 KOLOM (KIRI: ILUSTRASI | KANAN: PESAN TEXT) -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-10 items-center bg-white/5 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-white/10 shadow-2xl">
            
            <!-- SEBELAH KIRI: GAMBAR / ILUSTRASI (COL 5 DESKTOP) -->
            <div class="md:col-span-5 flex justify-center relative group">
                <div class="absolute inset-0 bg-sky-500/20 rounded-full blur-2xl transform group-hover:scale-105 transition duration-500"></div>
                <img
                    src="{{ asset('assets/img/404.png') }}"
                    alt="Ilustrasi teknisi IJCS - Halaman tidak ditemukan"
                    class="relative z-10 w-full max-w-xs md:max-w-full h-auto object-contain drop-shadow-2xl transition-transform duration-500 group-hover:-translate-y-1"
                >
            </div>

            <!-- SEBELAH KANAN: JUDUL & TULISAN DESKRIPSI (COL 7 DESKTOP - TEXT ALIGN LEFT DI DESKTOP) -->
            <div class="md:col-span-7 text-center md:text-left space-y-3">
                <span class="inline-block px-3 py-1 bg-sky-500/20 text-sky-400 text-xs font-bold tracking-[0.2em] uppercase rounded-full border border-sky-500/30">
                    Error 404 • Page Not Found
                </span>

                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight text-white leading-tight">
                    Halaman Tidak Ditemukan
                </h1>

                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-md mx-auto md:mx-0">
                    Waduh! Sepertinya halaman yang kamu cari tidak tersedia, mungkin sudah dipindahkan, dihapus, atau alamat URL yang dimasukkan salah.
                </p>
            </div>

        </div>

        <!-- TOMBOL KEMBALI DI BAWAH (TETAP CENTER DI TENGAH) -->
        <div>
            <a
                href="{{ route('public.home') }}"
                class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-black text-xs sm:text-sm px-8 py-3.5 rounded-2xl shadow-lg shadow-sky-500/20 transition-all duration-300 hover:-translate-y-1 active:scale-95 cursor-pointer"
            >
                <i class="fa-solid fa-house text-xs"></i>
                <span>Kembali ke Halaman Utama</span>
            </a>
        </div>

        <!-- FOOTER -->
        <footer class="text-[11px] text-slate-500 pt-2">
            &copy; {{ date('Y') }} IJCS - Indra Jaya Computer Service. All rights reserved.
        </footer>

    </main>

</body>
</html>