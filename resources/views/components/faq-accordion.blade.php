<section id="faq" x-data="{ activeFaq: null }" class="py-16 md:py-24 bg-slate-50/70 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER SECTION -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-3">
                Sering Ditanyakan
            </h2>
            <p class="mt-2.5 text-gray-600 text-sm sm:text-base">
                Informasi seputar layanan perbaikan, garansi, dan keamanan perangkat kamu di IJCS.
            </p>
        </div>

        <!-- ACCORDION LIST -->
        <div class="space-y-4">
            
            <!-- FAQ 1 -->
            <div class="bg-white rounded-2xl border border-gray-200/80 overflow-hidden transition-all duration-200">
                <button 
                    @click="activeFaq = (activeFaq === 1 ? null : 1)" 
                    class="w-full text-left p-5 sm:p-6 font-bold text-gray-900 flex items-center justify-between text-sm sm:text-base focus:outline-none"
                >
                    <span>Berapa lama proses pengecekan atau diagnosa kerusakan?</span>
                    <i class="fa-solid fa-chevron-down text-sky-600 transition-transform duration-300" :class="{ 'rotate-180': activeFaq === 1 }"></i>
                </button>
                <div 
                    x-show="activeFaq === 1" 
                    x-collapse 
                    class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4"
                >
                    Pengecekan ringan (seperti masalah software, RAM, SSD, atau printer infus) bisa ditunggu sekitar **15 - 30 menit**. Untuk kendala mesin/motherboard mati total, butuh waktu pengecekan **1x24 jam** agar hasilnya akurat.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-2xl border border-gray-200/80 overflow-hidden transition-all duration-200">
                <button 
                    @click="activeFaq = (activeFaq === 2 ? null : 2)" 
                    class="w-full text-left p-5 sm:p-6 font-bold text-gray-900 flex items-center justify-between text-sm sm:text-base focus:outline-none"
                >
                    <span>Bagaimana jika setelah di-cek saya tidak jadi servis?</span>
                    <i class="fa-solid fa-chevron-down text-sky-600 transition-transform duration-300" :class="{ 'rotate-180': activeFaq === 2 }"></i>
                </button>
                <div 
                    x-show="activeFaq === 2" 
                    x-collapse 
                    class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4"
                >
                    **100% Gratis!** Jika hasil diagnosa biaya dirasa tidak sesuai anggaran kamu dan kamu memutuskan batal servis, perangkat bisa langsung diambil kembali tanpa dipungut biaya pengecekan sepeser pun.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-2xl border border-gray-200/80 overflow-hidden transition-all duration-200">
                <button 
                    @click="activeFaq = (activeFaq === 3 ? null : 3)" 
                    class="w-full text-left p-5 sm:p-6 font-bold text-gray-900 flex items-center justify-between text-sm sm:text-base focus:outline-none"
                >
                    <span>Apakah data penting di laptop/PC saya aman?</span>
                    <i class="fa-solid fa-chevron-down text-sky-600 transition-transform duration-300" :class="{ 'rotate-180': activeFaq === 3 }"></i>
                </button>
                <div 
                    x-show="activeFaq === 3" 
                    x-collapse 
                    class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4"
                >
                    Data kamu terjamin **aman & terjaga kerahasiaannya**. Teknisi kami hanya fokus mengerjakan perbaikan hardware atau OS sesuai kendala, tanpa mengutak-atik dokumen pribadi kamu.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-2xl border border-gray-200/80 overflow-hidden transition-all duration-200">
                <button 
                    @click="activeFaq = (activeFaq === 4 ? null : 4)" 
                    class="w-full text-left p-5 sm:p-6 font-bold text-gray-900 flex items-center justify-between text-sm sm:text-base focus:outline-none"
                >
                    <span>Berapa lama garansi yang diberikan IJCS?</span>
                    <i class="fa-solid fa-chevron-down text-sky-600 transition-transform duration-300" :class="{ 'rotate-180': activeFaq === 4 }"></i>
                </button>
                <div 
                    x-show="activeFaq === 4" 
                    x-collapse 
                    class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4"
                >
                    Kami memberikan **Garansi Jasa & Sparepart hingga 30 Hari** untuk kerusakan yang sama. Jika ada kendala selama masa garansi, kamu tinggal bawa kembali nota servisnya ke toko.
                </div>
            </div>

        </div>

    </div>
</section>