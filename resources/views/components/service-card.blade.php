<section id="layanan" x-data="{ activeIndex: 0 }" class="py-20 md:py-28 bg-gradient-to-b from-slate-50 via-gray-50 to-sky-50/50 relative overflow-hidden">
    
    <!-- AKSEN GLOW HALUS BACKGROUND -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-sky-200/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER SECTION -->
        <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16">
      
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-3">
                Spesialis Perbaikan Perangkat
            </h2>
            <p class="mt-2.5 text-gray-600 text-sm sm:text-base leading-relaxed">
                Penanganan cepat, transparan, dan menggunakan sparepart berkualitas dengan garansi toko.
            </p>
        </div>

        <!-- WRAPPER CARDS -->
        <div class="relative">
            <!-- Gradien Halus di Kanan Layar HP (Petunjuk Swipe) -->
            <div class="md:hidden absolute top-0 right-0 bottom-6 w-8 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

            <!-- CONTAINER CARDS -->
            <div 
                x-ref="slider"
                @scroll.debounce.50ms="
                    const container = $refs.slider;
                    const cardWidth = container.firstElementChild.offsetWidth;
                    activeIndex = Math.round(container.scrollLeft / cardWidth);
                "
                class="flex md:grid md:grid-cols-3 gap-6 lg:gap-8 overflow-x-auto snap-x snap-mandatory pb-8 md:pb-12 -mx-4 px-4 md:mx-0 md:px-0 [&-::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]"
            >
                
                <!-- CARD 1: LAPTOP & PC -->
                <div class="w-[85vw] sm:w-[350px] md:w-auto shrink-0 snap-center bg-white hover:bg-slate-50/80 rounded-3xl p-7 border border-gray-200/80 hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Header Card & Icon Utama -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 bg-sky-500 text-white rounded-2xl flex items-center justify-center text-xl shadow-md shadow-sky-500/20 group-hover:scale-110 transition-transform duration-300">
                                <i class="fa-solid fa-laptop"></i>
                            </div>
                            <span class="bg-amber-50 text-amber-700 border border-amber-200/60 text-[11px] font-bold px-3 py-1 rounded-full">
                                Bisa Ditunggu
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-sky-600 transition-colors duration-300">
                            Servis Laptop & PC
                        </h3>
                        <p class="text-gray-600 text-xs sm:text-sm mt-2 leading-relaxed">
                            Penanganan software dan hardware dari instal ulang hingga servis mesin mati total.
                        </p>

                        <!-- Feature List -->
                        <ul class="mt-6 space-y-2.5 text-xs text-gray-700 border-t border-gray-100 pt-5">
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                    <span>Instal OS & Aplikasi Kerja</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">1 - 2 Jam</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                    <span>Upgrade SSD NVMe / RAM</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">30 Menit</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                    <span>Ganti Keyboard & Layar LCD</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Siap Pakai</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                    <span>Servis Motherboard / Chipset</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">1 - 3 Hari</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Card -->
                    <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-sky-600">Garansi 30 Hari</span>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20IJCS,%20saya%20mau%20konsultasi%20servis%20laptop" target="_blank" class="text-xs font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                            <span>Konsultasi</span>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD 2: PRINTER -->
                <div class="w-[85vw] sm:w-[350px] md:w-auto shrink-0 snap-center bg-white hover:bg-slate-50/80 rounded-3xl p-7 border border-gray-200/80 hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Header Card & Icon Utama -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-xl shadow-md shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                                <i class="fa-solid fa-print"></i>
                            </div>
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-[11px] font-bold px-3 py-1 rounded-full">
                                Pengerjaan Cepat
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300">
                            Servis & Modif Printer
                        </h3>
                        <p class="text-gray-600 text-xs sm:text-sm mt-2 leading-relaxed">
                            Perbaikan printer bergaris, paper jam, mati total, hingga pasang sistem infus.
                        </p>

                        <!-- Feature List -->
                        <ul class="mt-6 space-y-2.5 text-xs text-gray-700 border-t border-gray-100 pt-5">
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Pemasangan Sistem Infus (CISS)</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Rapi</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Atasi Hasil Cetak Putus</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Bisa Ditunggu</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Ganti Cartridge & Printhead</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Original</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Reset Waste Ink Pad</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">15 Menit</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Card -->
                    <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-emerald-600">Garansi 30 Hari</span>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20IJCS,%20saya%20mau%20konsultasi%20servis%20printer" target="_blank" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                            <span>Konsultasi</span>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD 3: SPAREPART & RAKIT PC -->
                <div class="w-[85vw] sm:w-[350px] md:w-auto shrink-0 snap-center bg-white hover:bg-slate-50/80 rounded-3xl p-7 border border-gray-200/80 hover:border-indigo-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Header Card & Icon Utama -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 bg-indigo-500 text-white rounded-2xl flex items-center justify-center text-xl shadow-md shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-300">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <span class="bg-indigo-50 text-indigo-700 border border-indigo-200/60 text-[11px] font-bold px-3 py-1 rounded-full">
                                Stok Ready
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                            Sparepart & Rakit PC
                        </h3>
                        <p class="text-gray-600 text-xs sm:text-sm mt-2 leading-relaxed">
                            Komponen komputer original bergaransi serta perakitan PC kustom.
                        </p>

                        <!-- Feature List -->
                        <ul class="mt-6 space-y-2.5 text-xs text-gray-700 border-t border-gray-100 pt-5">
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    <span>Charger & Baterai Laptop</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Original</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    <span>Tinta Botol Epson / Canon / HP</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">High Quality</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    <span>Rakit PC Kantor & Gaming</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Sesuai Budget</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    <span>Pembersihan & Ganti Thermal Paste</span>
                                </span>
                                <span class="text-[11px] text-gray-400 font-mono">Suhu Dingin</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Card -->
                    <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-indigo-600">Garansi Resmi</span>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20IJCS,%20saya%20mau%20tanya%20stok%20sparepart" target="_blank" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                            <span>Cek Stok</span>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- INDIKATOR SWIPE AKTIF DI MOBILE (PINDAH OTOMATIS) -->
        <div class="flex md:hidden justify-center items-center gap-2 mt-2">
            <template x-for="(item, index) in [0, 1, 2]" :key="index">
                <button 
                    @click="
                        activeIndex = index;
                        $refs.slider.scrollTo({
                            left: index * $refs.slider.firstElementChild.offsetWidth,
                            behavior: 'smooth'
                        });
                    "
                    class="transition-all duration-300 rounded-full"
                    :class="activeIndex === index ? 'w-6 h-2 bg-sky-600' : 'w-2 h-2 bg-gray-300'"
                    :aria-label="'Go to slide ' + (index + 1)"
                ></button>
            </template>
        </div>

    </div>
</section>