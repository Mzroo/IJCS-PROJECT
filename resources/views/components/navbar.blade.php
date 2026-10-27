<header x-data="{ open: false }" class="sticky top-0 z-50">
    <!-- 1. TOPBAR INFORMASI (Desain Tanpa Background Kotak di Jam Buka) -->
    <div class="hidden md:block bg-sky-600 text-sky-100 text-xs font-medium border-b border-sky-400/30 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            <!-- SEBELAH KIRI: Alamat & Slogan -->
            <div class="flex items-center space-x-4">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-location-dot text-sky-300"></i>
                    <span>Muara Gembong, Kab. Bekasi</span>
                </span>
                <span class="text-sky-400/60">|</span>
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-halved text-emerald-300"></i>
                    <span>Garansi Pengerjaan & Check-Up Gratis</span>
                </span>
            </div>

            <!-- SEBELAH KANAN: Jam Operasional (Clean Text Tanpa Background) -->
            <div class="flex items-center gap-2">
                <span class="font-bold text-white">Buka Hari Ini:</span>
                <span class="text-sky-100">Senin - Sabtu (08.00 - 17.00 WIB)</span>
            </div>

        </div>
    </div>

    <!-- 2. NAVBAR UTAMA (GRADIEN BIRU LANGIT / SKY BLUE) -->
    <nav class="bg-gradient-to-r from-sky-400 via-sky-500 to-blue-500 text-white shadow-md transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- BRAND LOGO -->
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur-md text-white rounded-xl flex items-center justify-center text-xl group-hover:scale-105 transition border border-white/30 shadow-inner">
                        <i class="fa-solid fa-laptop-medical"></i>
                    </div>
                    <div>
                        <span class="text-xl font-black tracking-wider block leading-none drop-shadow-sm">IJCS</span>
                        <span class="text-[10px] font-semibold text-sky-100 uppercase tracking-tight">Indra Jaya Computer</span>
                    </div>
                </a>

                <!-- DESKTOP MENU (RATA KANAN DENGAN EFEK GARIS BAWAH PUTIH) -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold h-16">
                    <a href="{{ url('/') }}" class="h-full flex items-center text-sky-50 hover:text-white border-b-2 border-transparent hover:border-white transition-all duration-200">
                        Beranda
                    </a>
                    <a href="{{ url('/') }}#tracking" class="h-full flex items-center text-sky-50 hover:text-white border-b-2 border-transparent hover:border-white transition-all duration-200">
                        Cek Status
                    </a>
                    <a href="{{ url('/') }}#layanan" class="h-full flex items-center text-sky-50 hover:text-white border-b-2 border-transparent hover:border-white transition-all duration-200">
                        Katalog
                    </a>
                    <a href="{{ url('/') }}#biaya" class="h-full flex items-center text-sky-50 hover:text-white border-b-2 border-transparent hover:border-white transition-all duration-200">
                        Biaya
                    </a>
                    <a href="{{ url('/') }}#kontak" class="h-full flex items-center text-sky-50 hover:text-white border-b-2 border-transparent hover:border-white transition-all duration-200">
                        Lokasi
                    </a>
                </div>

                <!-- MOBILE HAMBURGER BUTTON -->
                <div class="flex md:hidden items-center">
                    <button @click="open = !open" type="button" class="p-2 rounded-xl bg-white/15 hover:bg-white/25 text-white focus:outline-none transition border border-white/20">
                        <i class="fa-solid" :class="open ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- MOBILE DROPDOWN MENU -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="open = false"
             class="md:hidden bg-sky-600/95 backdrop-blur-lg border-t border-sky-400/40 px-4 pt-2 pb-5 space-y-1 shadow-xl">
            
            <a href="{{ url('/') }}" class="block px-3 py-2.5 rounded-lg text-sky-50 hover:text-white hover:bg-white/15 font-semibold text-sm transition">
                Beranda
            </a>
            <a href="{{ url('/') }}#tracking" class="block px-3 py-2.5 rounded-lg text-sky-50 hover:text-white hover:bg-white/15 font-semibold text-sm transition">
                Cek Status Servis
            </a>
            <a href="{{ url('/') }}#layanan" class="block px-3 py-2.5 rounded-lg text-sky-50 hover:text-white hover:bg-white/15 font-semibold text-sm transition">
                Katalog Sparepart
            </a>
            <a href="{{ url('/') }}#biaya" class="block px-3 py-2.5 rounded-lg text-sky-50 hover:text-white hover:bg-white/15 font-semibold text-sm transition">
                Estimasi Biaya
            </a>
            <a href="{{ url('/') }}#kontak" class="block px-3 py-2.5 rounded-lg text-sky-50 hover:text-white hover:bg-white/15 font-semibold text-sm transition">
                Lokasi Toko
            </a>
        </div>
    </nav>
</header>