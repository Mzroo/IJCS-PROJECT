<header class="h-16 bg-white border-b border-gray-200/80 shadow-sm px-4 sm:px-6 flex items-center justify-between shrink-0 relative z-30">
    <div class="flex items-center space-x-3">
        <!-- Tombol Toggle Mobile (Buka Sidebar Drawer) -->
        <button 
            type="button"
            @click="sidebarOpen = true" 
            class="md:hidden text-gray-600 hover:text-sky-600 hover:bg-sky-50 border border-transparent hover:border-sky-200 focus:outline-none p-2 rounded-xl transition-all duration-150"
        >
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- Tombol Toggle Desktop di Header -->
        <button 
            type="button"
            @click="sidebarCollapsed = !sidebarCollapsed" 
            class="hidden md:flex text-gray-500 hover:text-sky-600 hover:bg-sky-50 border border-transparent hover:border-sky-200 p-2 rounded-xl transition-all duration-150 focus:outline-none"
        >
            <i class="fa-solid fa-bars text-lg"></i>
        </button>
    </div>

    <!-- Right Quick Actions -->
    <div class="flex items-center space-x-3">
        <!-- Tombol Notifikasi -->
        <button 
            type="button"
            class="relative p-2.5 text-gray-500 hover:text-sky-600 hover:bg-sky-50 border border-transparent hover:border-sky-100 rounded-xl transition-all duration-150 focus:outline-none"
        >
            <i class="fa-regular fa-bell text-base"></i>
            <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
        </button>

        <div class="h-5 w-px bg-gray-200"></div>

        <!-- User Profile Dropdown (Alpine.js) -->
        <div class="relative" x-data="{ openProfile: false }">
            
            <!-- TOMBOL PROFIL DENGAN EFEK HOVER KOTAK BORDER TERANG -->
            <button 
                type="button"
                @click="openProfile = !openProfile" 
                @click.outside="openProfile = false"
                :class="openProfile ? 'bg-sky-50/80 border-sky-300 ring-2 ring-sky-500/20' : 'bg-slate-50/60 border-gray-200/80 hover:bg-slate-100 hover:border-gray-300'"
                class="flex items-center space-x-3 px-2.5 py-1.5 rounded-2xl border transition-all duration-150 focus:outline-none select-none cursor-pointer"
            >
                <!-- Avatar Inisial -->
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-500 text-white flex items-center justify-center font-black text-sm shadow-sm shadow-sky-500/20 uppercase">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>

                <!-- Teks Nama & Role -->
                <div class="hidden sm:block text-left">
                    <p class="text-xs font-bold text-gray-800 leading-tight">
                        {{ auth()->user()->name ?? 'Staf IJCS' }}
                    </p>
                    <p class="text-[10px] font-medium text-gray-500 mt-0.5">
                        {{ ucfirst(auth()->user()->role ?? 'Staf') }}
                    </p>
                </div>

                <!-- Panah Indicator -->
                <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200 hidden sm:block" :class="openProfile ? 'rotate-180 text-sky-600' : ''"></i>
            </button>

            <!-- MENU DROPDOWN -->
            <div 
                x-show="openProfile"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 py-1.5 z-50 divide-y divide-gray-100"
                x-cloak
            >
                <!-- Detail Pengguna (Mobile View Only) -->
                <div class="px-4 py-2 sm:hidden bg-slate-50/50">
                    <p class="text-xs font-bold text-gray-800">{{ auth()->user()->name ?? 'Staf IJCS' }}</p>
                    <p class="text-[10px] text-gray-500 truncate">{{ auth()->user()->email ?? 'staf@ijcs.com' }}</p>
                </div>

                <!-- Link Navigasi -->
                <div class="py-1 px-1">
                    <a href="#" class="flex items-center space-x-2.5 px-3 py-2 rounded-xl text-xs font-medium text-gray-700 hover:bg-sky-50 hover:text-sky-600 transition-all">
                        <i class="fa-regular fa-user w-4 text-center text-gray-400 group-hover:text-sky-600"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="/" target="_blank" class="flex items-center space-x-2.5 px-3 py-2 rounded-xl text-xs font-medium text-gray-700 hover:bg-sky-50 hover:text-sky-600 transition-all">
                        <i class="fa-solid fa-globe w-4 text-center text-gray-400 group-hover:text-sky-600"></i>
                        <span>Lihat Website</span>
                    </a>
                </div>

                <!-- FORM LOGOUT FIXING -->
                <div class="py-1 px-1">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button 
                            type="submit" 
                            class="w-full flex items-center space-x-2.5 px-3 py-2 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 transition-all text-left cursor-pointer"
                        >
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>