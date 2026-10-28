<section id="tracking" class="relative bg-gradient-to-r from-sky-400 via-sky-500 to-blue-500 text-white min-h-[calc(100vh-4rem)] flex items-center overflow-hidden py-8 sm:py-0">
    
    <!-- Latar Belakang Pola Titik Halus (Dots Grid) -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>

    <div class="relative max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-start lg:items-center">
            
            <!-- SEBELAH KIRI: FORM TRACKING & DESKRIPSI -->
            <div class="lg:col-span-7 text-center lg:text-left space-y-4 sm:space-y-6 z-10 -mt-2 lg:-mt-6">
                
                <!-- Badge Highlight -->
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/10 text-white text-[11px] sm:text-xs font-semibold px-3.5 py-1 rounded-full border border-white/15">
                        <i class="fa-solid fa-circle-check text-emerald-300 text-xs"></i>
                        <span>Check-Up Gratis & Garansi Toko</span>
                    </div>

                    <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black mt-3 leading-tight tracking-tight">
                        Mau Cek Laptop atau Printer? <br class="hidden sm:inline"> Pantau Progresnya di Sini!
                    </h1>
                    
                    <p class="mt-2 sm:mt-3 text-sky-100 text-xs sm:text-base max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Nggak perlu bolak-balik ke toko. Cukup masukkan nomor nota servis kamu buat lihat perangkatmu lagi dicek, dikerjakan, atau sudah siap diambil.
                    </p>
                </div>

                <!-- FORM INPUT TRACKING TIKET -->
                <div class="bg-white p-3 sm:p-4 rounded-2xl shadow-xl text-gray-800 max-w-lg mx-auto lg:mx-0 border border-sky-100">
                    <form action="" method="POST" class="flex flex-col sm:flex-row gap-2">
                        @csrf
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-sky-500">
                                <i class="fa-solid fa-ticket text-sm"></i>
                            </span>
                            <input 
                                type="text" 
                                name="ticket_number" 
                                placeholder="Ketik no. nota, contoh: IJCS-202610-001" 
                                required 
                                class="w-full pl-9 pr-3 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 font-mono font-bold uppercase text-xs sm:text-sm bg-gray-50/50 placeholder:normal-case placeholder:font-normal transition"
                            >
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-5 py-2.5 sm:py-3 rounded-xl font-bold transition shadow-md hover:shadow-lg flex items-center justify-center space-x-2 text-xs sm:text-sm whitespace-nowrap shrink-0">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            <span>Cek Sekarang</span>
                        </button>
                    </form>

                    <!-- Peringatan Lupa Tiket -->
                    <div class="mt-2 text-center lg:text-left">
                        <p class="text-[11px] sm:text-xs text-amber-700 font-medium flex items-center justify-center lg:justify-start gap-1.5 bg-amber-50/90 p-2 rounded-xl border border-amber-200/60">
                            <i class="fa-solid fa-circle-exclamation text-amber-500 shrink-0"></i>
                            <span>Lupa nomor nota? Hubungi WhatsApp Admin IJCS.</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- SEBELAH KANAN: GAMBAR TEKNISI & CARD FLOATING NATURAL (COL 5) -->
            <div class="hidden lg:flex lg:col-span-5 flex-col items-center justify-center relative z-10">
                
                <!-- Wrapper Gambar Teknisi -->
                <div class="relative w-full max-w-sm flex flex-col items-center justify-center">
                    <!-- Glow Halus di Belakang Badan Teknisi -->
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-3xl transform scale-90 -z-10"></div>

                    <!-- Gambar Teknisi Laptop IJCS -->
                    <img 
                        src="{{ asset('assets/img/hero-bg.png') }}" 
                        alt="Teknisi IJCS Memperbaiki Laptop" 
                        class="relative z-10 w-full h-auto object-contain max-h-[320px] xl:max-h-[370px] drop-shadow-xl transition-transform duration-300"
                    >

                    <!-- Bayangan Lantai Realistis -->
                    <div class="w-3/4 h-3 bg-slate-950/40 rounded-[100%] blur-sm -mt-2 relative z-10"></div>
                </div>

                <!-- 3 CARD STATISTIK FLOATING (TANPA CONTAINER PEMBUNGKUS) -->
                <div class="w-full grid grid-cols-3 gap-2.5 -mt-6 xl:-mt-8 relative z-20">
                    
                    <!-- Card 1: Pelanggan Terbantu -->
                    <div class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 p-3 rounded-2xl text-center shadow-lg transition duration-200">
                        <i class="fa-solid fa-users text-emerald-300 text-base mb-1 block"></i>
                        <h4 class="text-xs sm:text-sm font-black text-white leading-tight">1.250+</h4>
                        <p class="text-[9px] sm:text-[10px] text-sky-100 mt-0.5 leading-tight font-medium">Pelanggan</p>
                    </div>

                    <!-- Card 2: Stok Sparepart -->
                    <div class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 p-3 rounded-2xl text-center shadow-lg transition duration-200">
                        <i class="fa-solid fa-boxes-stacked text-amber-300 text-base mb-1 block"></i>
                        <h4 class="text-xs sm:text-sm font-black text-white leading-tight">500+</h4>
                        <p class="text-[9px] sm:text-[10px] text-sky-100 mt-0.5 leading-tight font-medium">Sparepart</p>
                    </div>

                    <!-- Card 3: Kepuasan Pelanggan -->
                    <div class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 p-3 rounded-2xl text-center shadow-lg transition duration-200">
                        <i class="fa-solid fa-award text-sky-200 text-base mb-1 block"></i>
                        <h4 class="text-xs sm:text-sm font-black text-white leading-tight">99%</h4>
                        <p class="text-[9px] sm:text-[10px] text-sky-100 mt-0.5 leading-tight font-medium">Puas & Garansi</p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>