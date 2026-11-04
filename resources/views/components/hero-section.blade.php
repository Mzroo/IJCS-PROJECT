<section 
    id="tracking" 
    x-data="{
        showScanner: false,
        html5QrCode: null,
        scannerError: '',
        
        startScanner() {
            this.showScanner = true;
            this.scannerError = '';
            
            $nextTick(() => {
                if (!this.html5QrCode) {
                    this.html5QrCode = new Html5Qrcode('reader');
                }
                
                const config = { fps: 10, qrbox: { width: 200, height: 200 } };
                
                this.html5QrCode.start(
                    { facingMode: 'environment' }, 
                    config, 
                    (decodedText) => {
                        let ticket = decodedText;
                        if (ticket.includes('/track/')) {
                            ticket = ticket.split('/track/').pop();
                        }
                        
                        const inputEl = document.querySelector('input[name=ticket_number]');
                        if (inputEl) {
                            inputEl.value = ticket.trim();
                        }
                        
                        this.stopScanner();
                        document.querySelector('#tracking-form').submit();
                    },
                    (errorMessage) => {}
                ).catch(err => {
                    this.scannerError = 'Gagal membuka kamera. Pastikan izin kamera telah diberikan.';
                });
            });
        },
        
        stopScanner() {
            if (this.html5QrCode && this.html5QrCode.isScanning) {
                this.html5QrCode.stop().then(() => {
                    this.showScanner = false;
                }).catch(err => {
                    this.showScanner = false;
                });
            } else {
                this.showScanner = false;
            }
        }
    }"
    class="relative bg-gradient-to-r from-sky-400 via-sky-500 to-blue-600 text-white min-h-[calc(100vh-4rem)] lg:h-[calc(100vh-4rem)] flex items-center justify-center overflow-hidden py-6 lg:py-0"
>
    
    <!-- Latar Belakang Pola Titik & Ambient Glow Orb -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-sky-300/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-700/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
            
            <!-- SEBELAH KIRI: FORM TRACKING & DESKRIPSI (COL 5) -->
            <div class="lg:col-span-5 text-center lg:text-left space-y-3.5 sm:space-y-4 z-10">
                
                <!-- Badge Highlight -->
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md text-white text-[11px] sm:text-xs font-semibold px-3.5 py-1 rounded-full border border-white/20 shadow-inner">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                        </span>
                        <span class="tracking-wide">System Real-Time • Check-Up Gratis & Garansi Toko</span>
                    </div>

                    <!-- Judul Utama -->
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black mt-2 leading-tight tracking-tight drop-shadow-xs">
                        Mau Cek Laptop & Printer? <br class="hidden sm:inline">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-200 via-white to-sky-100">
                            Pantau Progresnya
                        </span> Langsung!
                    </h1>
                    
                    <p class="mt-2 text-sky-100 text-xs sm:text-sm max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Nggak perlu ribet bolak-balik ke toko. Cukup masukkan nomor nota atau scan QR Code pada nota servis kamu.
                    </p>
                </div>

                <!-- NOTIFIKASI ERROR JIKA TIKET TIDAK DITEMUKAN -->
                @if ($errors->has('ticket_number'))
                    <div class="p-3 bg-rose-500/90 backdrop-blur-md border border-rose-200/50 text-white text-xs font-bold rounded-2xl shadow-lg max-w-lg mx-auto lg:mx-0 text-left flex items-center gap-2.5">
                        <i class="fa-solid fa-triangle-exclamation text-base shrink-0"></i>
                        <span>{{ $errors->first('ticket_number') }}</span>
                    </div>
                @endif

                <!-- FORM INPUT TRACKING TIKET -->
                <div class="bg-white/95 backdrop-blur-xl p-3 sm:p-4 rounded-2xl shadow-xl text-gray-800 max-w-lg mx-auto lg:mx-0 border border-white/60">
                    <form id="tracking-form" action="{{ route('public.track.search') }}" method="POST" class="flex flex-col sm:flex-row gap-2">
                        @csrf
                        <div class="relative flex-1 flex items-center">
                            <span class="absolute left-3.5 text-sky-500 pointer-events-none">
                                <i class="fa-solid fa-ticket text-sm"></i>
                            </span>
                            
                            <input 
                                type="text" 
                                name="ticket_number" 
                                value="{{ old('ticket_number') }}"
                                placeholder="Contoh: TK-TL7MIKIGN" 
                                required 
                                class="w-full pl-9 pr-11 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 font-mono font-black uppercase text-xs sm:text-sm bg-gray-50/80 placeholder:normal-case placeholder:font-normal transition"
                            >

                            <!-- TOMBOL SCANNER KAMERA MOBILE & DESKTOP -->
                            <button 
                                type="button" 
                                @click="startScanner()"
                                title="Scan QR Code Nota"
                                class="absolute right-1.5 p-2 bg-sky-100 hover:bg-sky-200 text-sky-700 rounded-lg transition cursor-pointer flex items-center justify-center active:scale-95"
                            >
                                <i class="fa-solid fa-qrcode text-sm sm:text-base"></i>
                            </button>
                        </div>

                        <button type="submit" class="bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white px-5 py-2.5 sm:py-3 rounded-xl font-black transition shadow-md hover:shadow-sky-500/30 flex items-center justify-center space-x-2 text-xs sm:text-sm whitespace-nowrap shrink-0 cursor-pointer active:scale-95">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            <span>Cek Sekarang</span>
                        </button>
                    </form>

                    <!-- Peringatan Lupa Tiket -->
                    <div class="mt-2 text-center lg:text-left">
                        <p class="text-[11px] sm:text-xs text-amber-800 font-medium flex items-center justify-center lg:justify-start gap-1.5 bg-amber-50/90 p-2 rounded-xl border border-amber-200/80">
                            <i class="fa-solid fa-circle-exclamation text-amber-500 shrink-0"></i>
                            <span>Lupa nomor nota? Hubungi <a href="https://wa.me/6281234567890" target="_blank" class="font-bold underline text-amber-900 hover:text-amber-950">WhatsApp Admin IJCS</a>.</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- SEBELAH KANAN: GAMBAR TEKNISI TUNGGAL (DIGESER KE KANAN VIA lg:pl-8 xl:pl-12 - COL 7) -->
            <div class="hidden lg:flex lg:col-span-7 flex-col items-center justify-center relative z-10 lg:pl-8 xl:pl-12">
                
                <!-- WRAPPER GAMBAR TEKNISI DENGAN PENDARKAN AURA & UKURAN MAKSIMAL -->
                <div class="relative w-full max-w-lg xl:max-w-xl flex flex-col items-center justify-center group">
                    <!-- Glow Aura Belakang Gambar -->
                    <div class="absolute inset-0 bg-white/25 rounded-full blur-3xl transform scale-100 group-hover:scale-105 transition duration-500 -z-10"></div>

                    <!-- Gambar Teknisi (Max-Height Disesuaikan Proporsional) -->
                    <img 
                        src="{{ asset('assets/img/hero-bg.png') }}" 
                        alt="Teknisi IJCS Memperbaiki Laptop" 
                        class="relative z-10 w-full h-auto object-contain max-h-[320px] xl:max-h-[340px] drop-shadow-2xl transition-transform duration-500 group-hover:-translate-y-1 scale-105"
                    >

                    <!-- Bayangan Lantai Realistis -->
                    <div class="w-4/5 h-4 bg-slate-950/40 rounded-[100%] blur-md -mt-4 relative z-10"></div>
                </div>

                <!-- 3 CARD STATISTIK FLOATING -->
                <div class="w-full max-w-lg xl:max-w-xl grid grid-cols-3 gap-3 -mt-8 xl:-mt-10 relative z-20">
                    <div class="bg-white/15 hover:bg-white/25 backdrop-blur-xl border border-white/30 p-2.5 sm:p-3 rounded-2xl text-center shadow-xl hover:-translate-y-1 transition duration-300">
                        <i class="fa-solid fa-users text-emerald-300 text-base mb-0.5 block"></i>
                        <h4 class="text-xs sm:text-sm font-black text-white leading-tight">1.250+</h4>
                        <p class="text-[9px] sm:text-[10px] text-sky-100 mt-0.5 leading-tight font-medium">Pelanggan</p>
                    </div>

                    <div class="bg-white/15 hover:bg-white/25 backdrop-blur-xl border border-white/30 p-2.5 sm:p-3 rounded-2xl text-center shadow-xl hover:-translate-y-1 transition duration-300">
                        <i class="fa-solid fa-boxes-stacked text-amber-300 text-base mb-0.5 block"></i>
                        <h4 class="text-xs sm:text-sm font-black text-white leading-tight">500+</h4>
                        <p class="text-[9px] sm:text-[10px] text-sky-100 mt-0.5 leading-tight font-medium">Sparepart</p>
                    </div>

                    <div class="bg-white/15 hover:bg-white/25 backdrop-blur-xl border border-white/30 p-2.5 sm:p-3 rounded-2xl text-center shadow-xl hover:-translate-y-1 transition duration-300">
                        <i class="fa-solid fa-award text-sky-200 text-base mb-0.5 block"></i>
                        <h4 class="text-xs sm:text-sm font-black text-white leading-tight">99%</h4>
                        <p class="text-[9px] sm:text-[10px] text-sky-100 mt-0.5 leading-tight font-medium">Puas & Garansi</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- MODAL KAMERA SCANNER QR CODE -->
    <div 
        x-show="showScanner" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-md"
        style="display: none;"
    >
        <div class="bg-white text-slate-800 rounded-3xl max-w-xs w-full p-4 shadow-2xl border border-slate-100 relative">
            
            <div class="flex items-center justify-between pb-2 border-b border-slate-100 mb-3">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-camera text-sky-600 text-sm"></i>
                    <h3 class="text-xs font-black text-slate-900">Scan QR Code Nota</h3>
                </div>
                <button 
                    @click="stopScanner()"
                    class="w-6 h-6 bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-full flex items-center justify-center transition cursor-pointer text-xs"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="relative overflow-hidden rounded-2xl bg-slate-950 aspect-square flex items-center justify-center border border-slate-200">
                <div id="reader" class="w-full h-full"></div>
            </div>

            <template x-if="scannerError">
                <p class="mt-2 text-[11px] font-bold text-rose-600 bg-rose-50 p-2 rounded-xl text-center" x-text="scannerError"></p>
            </template>

            <p class="text-[10px] text-slate-500 text-center mt-2.5">
                Arahkan kamera HP ke QR Code pada nota perbaikan unit.
            </p>
        </div>
    </div>

</section>

<!-- SCRIPT LIBRARY HTML5-QRCODE -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>