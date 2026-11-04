<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Perbaikan - {{ $service->ticket_number }}</title>
    
    <!-- BUNDLE VITE PROYEK -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 font-sans pb-12">

    <!-- HEADER SIMPEL -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-10 shadow-xs mb-6">
        <div class="max-w-xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-sky-600 rounded-xl flex items-center justify-center text-white font-black text-sm">
                    IJ
                </div>
                <div>
                    <h1 class="text-xs font-black tracking-wider text-slate-900 uppercase">Indra Jaya Computer</h1>
                    <p class="text-[10px] text-slate-500">Service Tracking Center</p>
                </div>
            </div>
            <a href="{{ route('public.home') }}" class="px-3 py-1 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-full border border-slate-200 transition">
                ← Kembali ke Home
            </a>
        </div>
    </header>

    <main class="max-w-xl mx-auto px-4">
        <!-- MEMANGGIL REUSABLE PARTIAL VIEW MODAL -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-md">
            @include('public.partials.track-modal')
        </div>
    </main>

</body>
</html>