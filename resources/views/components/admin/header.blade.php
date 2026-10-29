<header class="h-16 bg-white border-b border-gray-200/80 shadow-sm px-4 sm:px-6 flex items-center justify-between shrink-0 relative z-10">
    <div class="flex items-center space-x-3">
        <!-- Tombol Toggle Mobile (Buka Sidebar Drawer) -->
        <button @click="sidebarOpen = true" class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- Tombol Toggle Desktop di Header (Alternatif Buka/Tutup) -->
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden md:flex text-gray-500 hover:text-gray-800 p-2 rounded-lg hover:bg-gray-100 transition">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

    </div>

    <!-- Right Quick Actions -->
    <div class="flex items-center space-x-3">
        <!-- Tombol Notifikasi -->
        <button class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
            <i class="fa-regular fa-bell text-base"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full"></span>
        </button>

        <div class="h-5 w-px bg-gray-200"></div>

        <!-- User Profile Dropdown (Alpine.js) -->
        <div class="relative" x-data="{ openProfile: false }">
            <button 
                @click="openProfile = !openProfile" 
                @click.away="openProfile = false"
                class="flex items-center space-x-3 p-1.5 rounded-xl hover:bg-gray-100 transition focus:outline-none"
            >
                <div class="w-8 h-8 rounded-lg bg-sky-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                    A
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-xs font-semibold text-gray-800 leading-tight">Admin IJCS</p>
                    <p class="text-[10px] text-gray-500">Administrator</p>
                </div>
                <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-200 hidden sm:block" :class="openProfile ? 'rotate-180' : ''"></i>
            </button>

            <!-- Menu Dropdown -->
            <div 
                x-show="openProfile"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-lg border border-gray-100 py-1.5 z-50 divide-y divide-gray-100"
                x-cloak
            >
                <div class="px-4 py-2 sm:hidden">
                    <p class="text-xs font-semibold text-gray-800">Admin IJCS</p>
                    <p class="text-[10px] text-gray-500">admin@ijcs.com</p>
                </div>

                <div class="py-1">
                    <a href="#" class="flex items-center space-x-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-sky-600 transition">
                        <i class="fa-regular fa-user w-4 text-center"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="/" target="_blank" class="flex items-center space-x-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-sky-600 transition">
                        <i class="fa-solid fa-globe w-4 text-center"></i>
                        <span>Lihat Website</span>
                    </a>
                </div>

                <div class="py-1">
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50 transition text-left">
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>