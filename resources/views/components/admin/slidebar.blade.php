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
                <!-- Teks Logo -->
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
        
        <!-- SECTION 1: UTAMA (AKSES: ALL ROLE - OWNER, ADMIN, TEKNISI) -->
        <div class="h-4 my-2 flex items-center">
            <p 
                :class="sidebarCollapsed ? 'block md:hidden' : 'block'"
                class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap transition-all duration-200"
            >
                Utama
            </p>
        </div>

        <!-- Dashboard Link -->
        <a 
            href="{{ route('admin.dashboard') }}" 
            :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" 
            class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}" 
            title="Dashboard"
        >
            <i class="fa-solid fa-chart-line w-5 text-center shrink-0 text-base {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'group-hover:text-sky-400' }}"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Dashboard</span>
        </a>

        <!-- Tiket Servis Link -->
        <a 
            href="{{ route('services.index') }}" 
            :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" 
            class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('services.*') ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}" 
            title="Tiket Servis"
        >
            <i class="fa-solid fa-ticket w-5 text-center shrink-0 text-base transition-colors {{ request()->routeIs('services.*') ? 'text-white' : 'group-hover:text-sky-400' }}"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Tiket Servis</span>
        </a>

        <!-- Sparepart & Stok Link -->
        <a 
            href="#" 
            :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" 
            class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white text-slate-400 transition-all duration-200 group" 
            title="Sparepart & Stok"
        >
            <i class="fa-solid fa-boxes-stacked w-5 text-center group-hover:text-sky-400 shrink-0 text-base transition-colors"></i>
            <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Sparepart & Stok</span>
        </a>

        <!-- SECTION 2: KHUSUS OWNER (LAPORAN & MANAJEMEN AKUN) -->
        @if (auth()->user()->role === 'owner')
            <div class="h-4 mt-6 mb-2 flex items-center">
                <p 
                    :class="sidebarCollapsed ? 'block md:hidden' : 'block'"
                    class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap transition-all duration-200"
                >
                    Pemilik (Owner)
                </p>
            </div>

            <!-- Laporan Keuangan Link -->
            <a 
                href="{{ route('admin.reports.index') }}" 
                :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" 
                class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('admin.reports.*') ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}" 
                title="Laporan Keuangan"
            >
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center shrink-0 text-base transition-colors {{ request()->routeIs('admin.reports.*') ? 'text-white' : 'group-hover:text-sky-400' }}"></i>
                <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Laporan Keuangan</span>
            </a>

            <!-- Manajemen Staf & User Link -->
            <a 
                href="{{ route('admin.users.index') }}" 
                :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" 
                class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}" 
                title="Manajemen Staf"
            >
                <i class="fa-solid fa-users-gear w-5 text-center shrink-0 text-base transition-colors {{ request()->routeIs('admin.users.*') ? 'text-white' : 'group-hover:text-sky-400' }}"></i>
                <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Manajemen Staf</span>
            </a>
        @endif

        <!-- SECTION 3: PENGATURAN SYSTEM (KHUSUS OWNER & ADMIN) -->
        @if (in_array(auth()->user()->role ?? '', ['owner', 'admin']))
            <div class="h-4 mt-6 mb-2 flex items-center">
                <p 
                    :class="sidebarCollapsed ? 'block md:hidden' : 'block'"
                    class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap transition-all duration-200"
                >
                    Pengaturan
                </p>
            </div>

            <a 
                href="#" 
                :class="sidebarCollapsed ? 'justify-start md:justify-center px-3 md:px-0' : 'px-3'" 
                class="flex items-center space-x-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white text-slate-400 transition-all duration-200 group" 
                title="Pengaturan Toko"
            >
                <i class="fa-solid fa-gear w-5 text-center group-hover:text-sky-400 shrink-0 text-base transition-colors"></i>
                <span :class="sidebarCollapsed ? 'inline md:hidden' : 'inline'" class="whitespace-nowrap transition-all duration-200">Pengaturan Toko</span>
            </a>
        @endif

    </nav>
</aside>