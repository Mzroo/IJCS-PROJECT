<aside 
    :class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full': !sidebarOpen,
        'md:w-64': !sidebarCollapsed,
        'md:w-20': sidebarCollapsed
    }"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 transform md:relative md:translate-x-0 transition-all duration-300 ease-in-out flex flex-col shrink-0 overflow-hidden shadow-2xl md:shadow-none"
>
    <!-- Logo & Brand Header -->
    <div class="h-16 flex items-center px-4 bg-slate-950 border-b border-slate-800 shrink-0 transition-all duration-300">
        <div class="flex items-center space-x-3 w-full" :class="sidebarCollapsed ? 'md:justify-center justify-between' : 'justify-between'">
            <div class="flex items-center space-x-3 overflow-hidden">
                <div class="bg-sky-500 text-white p-2 rounded-xl shrink-0 flex items-center justify-center shadow-md shadow-sky-500/20">
                    <i class="fa-solid fa-laptop-code text-sm"></i>
                </div>
                <!-- Teks Logo: Selalu tampil di Mobile (block), ikuti x-show di Desktop (md:block / md:hidden) -->
                <span 
                    :class="sidebarCollapsed ? 'block md:hidden' : 'block'"
                    class="font-black text-lg text-white tracking-wider whitespace-nowrap transition-all duration-200"
                >
                    IJCS <span class="text-sky-400 text-xs font-semibold">ADMIN</span>
                </span>
            </div>

            <!-- Tombol Close Mobile -->
            <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Menu Links -->
    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto overflow-x-hidden">
        <!-- Label Section: Main Menu -->
        <div class="h-4 my-2 flex items-center">
            <p 
                :class="sidebarCollapsed ? 'block md:hidden' : 'block'"
                class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap transition-all duration-200"
            >
                Main Menu
            </p>
        </div>

        <!-- Dashboard Link -->
        <a href="#" :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium bg-sky-600 text-white shadow-md shadow-sky-600/20 transition-all duration-200 group" title="Dashboard">
            <i class="fa-solid fa-chart-line w-5 text-center shrink-0 text-base"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Dashboard</span>
        </a>

        <!-- Transaksi / Servis Link -->
        <a href="#" :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all duration-200 group" title="Tiket Servis">
            <i class="fa-solid fa-ticket w-5 text-center text-slate-400 group-hover:text-sky-400 shrink-0 text-base transition-colors"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Tiket Servis</span>
        </a>

        <!-- Stok Sparepart / Produk Link -->
        <a href="#" :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all duration-200 group" title="Sparepart & Stok">
            <i class="fa-solid fa-boxes-stacked w-5 text-center text-slate-400 group-hover:text-sky-400 shrink-0 text-base transition-colors"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Sparepart & Stok</span>
        </a>

        <!-- Data Pelanggan Link -->
        <a href="#" :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all duration-200 group" title="Pelanggan">
            <i class="fa-solid fa-users w-5 text-center text-slate-400 group-hover:text-sky-400 shrink-0 text-base transition-colors"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Pelanggan</span>
        </a>

        <!-- Label Section: Pengaturan -->
        <div class="h-4 mt-6 mb-2 flex items-center">
            <p 
                :class="sidebarCollapsed ? 'block md:hidden' : 'block'"
                class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap transition-all duration-200"
            >
                Pengaturan
            </p>
        </div>

        <a href="#" :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all duration-200 group" title="Pengaturan Toko">
            <i class="fa-solid fa-gear w-5 text-center text-slate-400 group-hover:text-sky-400 shrink-0 text-base transition-colors"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Pengaturan Toko</span>
        </a>
    </nav>
</aside>