@extends('layouts.app')

@section('title', 'IJCS - Servis Komputer, Laptop & Printer Terpercaya')

@section('content')

    {{-- 1. Hero Section & Form Tracking --}}
    @include('components.hero-section')

    {{-- 2. Spesialisasi Layanan --}}
    @include('components.service-card')

    {{-- 3. Katalog Sparepart & Aksesori --}}
    @include('components.product-card')

    {{-- 4. Alur Kerja Servis --}}
    @include('components.process-stepper')

    {{-- 5. Estimasi Biaya Jasa --}}
    @include('components.pricelist-table')

    {{-- 6. FAQ Accordion --}}
    @include('components.faq-accordion')

    {{-- 7. Lokasi Toko & Google Maps --}}
    @include('components.location-section')


    {{-- 9. Tombol Floating WhatsApp --}}
    @include('components.floating-wa')

@endsection