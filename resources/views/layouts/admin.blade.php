<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard - IJCS' }}</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Overlay Mobile saat Sidebar Buka -->
        <div 
            x-show="sidebarOpen" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden"
            x-cloak
        ></div>

        <!-- SIDEBAR INCLUDED -->
        @include('components.admin.slidebar')

        <!-- KONTEN UTAMA & HEADER -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- TOPBAR / HEADER INCLUDED -->
            @include('components.admin.header')

            <!-- MAIN CONTENT CONTAINER -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                @yield('content')
            </main>

            <!-- FOOTER ADMIN -->
            <footer class="bg-white border-t border-gray-200 px-6 py-4 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Indra Jaya Computer Service (IJCS). All rights reserved.
            </footer>
        </div>

    </div>

</body>
</html>