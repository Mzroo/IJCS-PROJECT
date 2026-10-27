<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'IJCS - Indra Jaya Computer Servis & Sparepart')</title>
    <meta name="description" content="@yield('meta_description', 'Layanan perbaikan laptop, komputer, dan printer terpercaya di IJCS. Diagnosa transparan, pengerjaan bergaransi, dan tracking servis online.')">
    <meta name="keywords" content="servis laptop, servis printer, servis komputer, ijcs, indra jaya computer, sparepart laptop, tracking servis">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Vite Assets (Tailwind CSS v4, Font Awesome 6, Poppins Font, Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen selection:bg-sky-500 selection:text-white">

    <!-- 1. NAVBAR COMPONENT -->
    @include('components.navbar')

    <!-- 2. MAIN CONTENT DYNAMIC -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 3. FOOTER COMPONENT -->
    @include('components.footer')

    <!-- 4. FLOATING WHATSAPP BUTTON -->
    @include('components.floating-wa')

    @stack('scripts')
</body>
</html>