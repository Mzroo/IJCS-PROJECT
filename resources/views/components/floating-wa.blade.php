<div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end font-sans">
    
    <!-- 1. POPUP CHAT BOX INTERAKTIF -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        @click.away="open = false"
        class="mb-4 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden"
    >
        <!-- Header Pop-up -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-4 text-white flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-lg font-bold border border-white/30">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-400 border-2 border-white rounded-full"></span>
                </div>
                <div>
                    <h4 class="font-bold text-sm leading-tight">Customer Service IJCS</h4>
                    <p class="text-[11px] text-emerald-100 flex items-center gap-1 mt-0.5">
                        <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-ping"></span>
                        Online & Siap Membantu
                    </p>
                </div>
            </div>
            <button @click="open = false" class="text-white/80 hover:text-white text-lg focus:outline-none transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Body Pop-up / Bubble Chat -->
        <div class="p-4 bg-slate-50 space-y-3 text-xs text-gray-700">
            <div class="bg-white p-3 rounded-xl rounded-tl-none shadow-sm border border-gray-100 leading-relaxed">
                Halo! 👋 Ada yang bisa kami bantu terkait perbaikan laptop, PC, printer, atau pembelian sparepart?
            </div>
            <p class="text-[10px] text-gray-400 text-right">Tim IJCS • Balas dalam beberapa menit</p>
        </div>

        <!-- Footer / Tombol Aksip ke WA -->
        <div class="p-3 bg-white border-t border-gray-100">
            <a 
                href="https://wa.me/6281234567890?text=Halo%20Admin%20IJCS,%20saya%20ingin%20konsultasi%20mengenai%20servis%20perangkat" 
                target="_blank" 
                class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2.5 px-4 rounded-xl font-bold text-xs flex items-center justify-center space-x-2 transition shadow-md hover:shadow-lg"
            >
                <i class="fa-brands fa-whatsapp text-base"></i>
                <span>Mulai Chat WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- 2. TOMBOL UTAMA (FLOATING BUTTON) -->
    <div class="relative group">
        <!-- Tooltip Petunjuk (Hanya Muncul Saat Hover & Pop-up Tertutup) -->
        <span 
            x-show="!open" 
            class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-gray-900 text-white text-xs font-semibold px-3 py-1.5 rounded-lg shadow-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none hidden sm:block"
        >
            Konsultasi WA
        </span>

        <!-- Tombol Lingkaran Melayang -->
        <button 
            @click="open = !open" 
            type="button"
            class="w-14 h-14 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full flex items-center justify-center text-2xl shadow-xl hover:scale-110 transition-all duration-300 focus:outline-none border-2 border-white/20 relative"
            aria-label="Hubungi via WhatsApp"
        >
            <!-- Badge Indikator Pesan Baru -->
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-amber-400 text-slate-900 text-[9px] font-black rounded-full flex items-center justify-center border border-white">
                1
            </span>

            <!-- Ikon Berganti saat Pop-up Terbuka -->
            <i class="fa-brands fa-whatsapp" x-show="!open"></i>
            <i class="fa-solid fa-xmark text-xl" x-show="open" x-cloak></i>
        </button>
    </div>

</div>