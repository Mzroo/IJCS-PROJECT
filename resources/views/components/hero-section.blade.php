<section id="tracking" class="relative bg-gradient-to-r from-sky-400 via-sky-500 to-blue-500 text-white py-10 lg:py-0 min-h-[calc(100vh-4rem)] flex items-center overflow-hidden">
    
    <!-- Latar Belakang Pola Titik Halus (Dots Grid) -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>

    <div class="relative max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
            
            <!-- SEBELAH KIRI: FORM TRACKING & DESKRIPSI (Col 7) -->
            <div class="lg:col-span-7 text-center lg:text-left space-y-6 z-10">
                
                <!-- Badge Highlight -->
                <div>
                    {{-- <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3.5 py-1.5 rounded-full border border-white/30 inline-flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-shield-halved text-emerald-300"></i> Cek Dulu Gratis, Baru Bayar
                    </span>
                     --}}
                    <h1 class="text-3xl sm:text-5xl font-black mt-4 leading-tight tracking-tight">
                        Mau Cek Laptop atau Printer? <br class="hidden sm:inline"> Pantau Progresnya di Sini!
                    </h1>
                    
                    <p class="mt-3 text-sky-100 text-sm sm:text-base max-w-xl mx-auto lg:mx-0">
                        Nggak perlu bolak balik ke toko. Cukup masukkan nomor nota servis kamu buat lihat alatmu lagi di cek, dikerjain, atau sudah siap diambil.
                    </p>
                </div>

                <!-- FORM INPUT TRACKING TIKET -->
                <div class="bg-white p-3.5 sm:p-4 rounded-2xl shadow-2xl text-gray-800 max-w-lg mx-auto lg:mx-0 border border-sky-100">
                    <form action="" method="POST" class="flex flex-col sm:flex-row gap-2.5">
                        @csrf
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-sky-500">
                                <i class="fa-solid fa-ticket text-base"></i>
                            </span>
                            <input 
                                type="text" 
                                name="ticket_number" 
                                placeholder="Ketik no. nota, contoh: IJCS-202610-001" 
                                required 
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 font-mono font-bold uppercase text-sm bg-gray-50/50 placeholder:normal-case placeholder:font-normal"
                            >
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-md hover:shadow-lg flex items-center justify-center space-x-2 text-sm whitespace-nowrap">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>Cek Sekarang</span>
                        </button>
                    </form>

                    <!-- Text Peringatan Lupa Tiket -->
                    <div class="mt-2.5 text-center lg:text-left">
                        <p class="text-xs text-amber-600 font-medium flex items-center justify-center lg:justify-start gap-1.5 bg-amber-50 p-2 rounded-lg border border-amber-200/60">
                            <i class="fa-solid fa-circle-exclamation text-amber-500"></i>
                            <span>Lupa atau kehilangan nomor nota? Silakan hubungi nomor WA Admin IJCS.</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- SEBELAH KANAN: GAMBAR TEKNISI & CARD STATISTIK HORIZONTAL (Col 5) -->
            <div class="hidden lg:flex lg:col-span-5 flex-col items-center justify-center relative z-10">
                
                <!-- Wrapper Gambar + Bayangan -->
                <div class="relative w-full max-w-md flex flex-col items-center justify-center">
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-3xl transform scale-90 -z-10"></div>

                    <img 
                        src="{{ asset('assets/img/hero-bg.png') }}" 
                        alt="Teknisi IJCS Memperbaiki Komputer" 
                        class="relative z-10 w-full h-auto object-contain max-h-[320px] xl:max-h-[380px] transform hover:scale-105 transition-transform duration-300"
                    >

                    <!-- BAYANGAN LANTAI REALISTIS -->
                    <div class="w-11/12 h-5 bg-slate-950/60 rounded-[100%] blur-md -mt-4 relative z-0"></div>
                </div>

                <!-- CARD STATISTIK HORIZONTAL -->
                <div class="w-full grid grid-cols-3 gap-2.5 mt-4">
                    
                    <!-- Card 1: Pelanggan Terbantu -->
                    <div class="bg-white/15 backdrop-blur-md border border-white/25 p-2.5 rounded-xl text-center shadow-lg hover:bg-white/20 transition">
                        <i class="fa-solid fa-users text-emerald-300 text-lg mb-1"></i>
                        <h4 class="text-sm font-black text-white leading-tight">1.250+</h4>
                        <p class="text-[10px] text-sky-100 mt-0.5 leading-tight">Pelanggan</p>
                    </div>

                    <!-- Card 2: Stok Sparepart -->
                    <div class="bg-white/15 backdrop-blur-md border border-white/25 p-2.5 rounded-xl text-center shadow-lg hover:bg-white/20 transition">
                        <i class="fa-solid fa-boxes-stacked text-amber-300 text-lg mb-1"></i>
                        <h4 class="text-sm font-black text-white leading-tight">500+</h4>
                        <p class="text-[10px] text-sky-100 mt-0.5 leading-tight">Sparepart</p>
                    </div>

                    <!-- Card 3: Kepuasan Pelanggan -->
                    <div class="bg-white/15 backdrop-blur-md border border-white/25 p-2.5 rounded-xl text-center shadow-lg hover:bg-white/20 transition">
                        <i class="fa-solid fa-award text-sky-200 text-lg mb-1"></i>
                        <h4 class="text-sm font-black text-white leading-tight">99%</h4>
                        <p class="text-[10px] text-sky-100 mt-0.5 leading-tight">Puas & Garansi</p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>