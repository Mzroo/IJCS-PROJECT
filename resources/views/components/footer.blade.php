<footer class="bg-slate-900 text-gray-300 pt-12 sm:pt-16 pb-8 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- GRID FOOTER UTAMA -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 pb-10 border-b border-slate-800">
            
            <!-- COL 1: BRANDING & DESKRIPSI TOKO (COL 5 DESKTOP) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-tr from-sky-400 to-blue-600 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-md">
                        IJ
                    </div>
                    <div>
                        <span class="text-xl font-black text-white tracking-tight">IJCS</span>
                        <span class="text-xs text-sky-400 font-bold block -mt-1">Computer & Printer Service</span>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-gray-400 leading-relaxed max-w-sm">
                    Pusat perbaikan laptop, PC, dan printer terpercaya di Muara Gembong. Melayani servis hardware, software, modifikasi printer, hingga penyediaan sparepart original bergaransi.
                </p>

                <div class="flex items-center space-x-3 pt-1">
                    <a href="https://wa.me/6281234567890" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-emerald-600 text-gray-300 hover:text-white flex items-center justify-center transition" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-blue-600 text-gray-300 hover:text-white flex items-center justify-center transition" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-pink-600 text-gray-300 hover:text-white flex items-center justify-center transition" aria-label="Instagram">
                        <i class="fa-brands fa-instagram text-base"></i>
                    </a>
                    <a href="https://maps.google.com" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-sky-600 text-gray-300 hover:text-white flex items-center justify-center transition" aria-label="Google Maps">
                        <i class="fa-solid fa-location-dot text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- CONTAINER MOBILE 2 KOLOM (KIRI: NAVIGASI | KANAN: KONTAK) -->
            <!-- Di Mobile tampil 2 Kolom (grid-cols-2), di Desktop menyatu ke Grid Utama (lg:contents) -->
            <div class="grid grid-cols-2 lg:contents gap-6 sm:gap-8">
                
                <!-- COL 2: NAVIGASI CEPAT (KIRI DI MOBILE, COL 3 DI DESKTOP) -->
                <div class="lg:col-span-3 space-y-3">
                    <h4 class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2 text-xs sm:text-sm">
                        <li>
                            <a href="{{ route('public.home') }}#tracking" class="text-gray-400 hover:text-sky-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[9px] text-sky-500 shrink-0"></i>
                                <span class="truncate">Status Servis</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.home') }}#layanan" class="text-gray-400 hover:text-sky-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[9px] text-sky-500 shrink-0"></i>
                                <span class="truncate">Spesialis Layanan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.home') }}#biaya" class="text-gray-400 hover:text-sky-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[9px] text-sky-500 shrink-0"></i>
                                <span class="truncate">Estimasi Biaya</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.home') }}#faq" class="text-gray-400 hover:text-sky-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[9px] text-sky-500 shrink-0"></i>
                                <span class="truncate">FAQ</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.home') }}#lokasi" class="text-gray-400 hover:text-sky-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[9px] text-sky-500 shrink-0"></i>
                                <span class="truncate">Lokasi Toko</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- COL 3: KONTAK & OPERASIONAL (KANAN DI MOBILE, COL 4 DI DESKTOP) -->
                <div class="lg:col-span-4 space-y-3">
                    <h4 class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Layanan Pelanggan</h4>
                    <div class="space-y-2.5 text-xs sm:text-sm text-gray-400">
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-headset text-sky-400 mt-1 shrink-0 text-xs"></i>
                            <span class="leading-tight">WA Admin: <br><strong class="text-white font-mono text-xs sm:text-sm">0812-3456-7890</strong></span>
                        </p>
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-clock text-emerald-400 mt-1 shrink-0 text-xs"></i>
                            <span class="leading-tight">Sen - Sab: 08.00-20.00<br><span class="text-amber-400">Min: 09.00-17.00</span></span>
                        </p>
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-shield-halved text-sky-400 mt-1 shrink-0 text-xs"></i>
                            <span class="leading-tight">Garansi Toko s/d 30 Hari</span>
                        </p>
                    </div>
                </div>

            </div>

        </div>

        <!-- BOTTOM COPYRIGHT & RAHASIA AKSES STAF -->
        <div class="pt-6 sm:pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-3">
            <p class="text-center sm:text-left">© {{ date('Y') }} IJCS (Indra Jaya Computer Service). All rights reserved.</p>
            
            <div class="flex items-center gap-3 text-[11px]">
                <span class="text-gray-600 hidden sm:inline">Didesain dengan presisi & efisiensi</span>
                <span class="text-slate-700 hidden sm:inline">•</span>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="font-bold text-sky-400 hover:text-sky-300 transition flex items-center gap-1">
                        <i class="fa-solid fa-gauge-high text-[10px]"></i>
                        <span>Dashboard Admin</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-400 transition flex items-center gap-1" title="Area Khusus Staf IJCS">
                        <i class="fa-solid fa-lock text-[9px]"></i>
                        <span>Akses Staf</span>
                    </a>
                @endauth
            </div>
        </div>

    </div>
</footer>