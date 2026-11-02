@extends('layouts.admin')

@section('title', 'Terima Unit Servis Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- HEADER PAGE -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-gray-900">Penerimaan Unit Servis Baru</h1>
            <p class="text-xs text-gray-500 mt-1">Catat data pelanggan dan keluhan perangkat laptop/komputer yang masuk</p>
        </div>
        <a href="{{ route('services.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-gray-700 text-xs font-bold rounded-xl transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- ERROR VALIDATION ALERT -->
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-2xl font-medium">
            <div class="font-bold mb-1">Terjadi kesalahan pada input data:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM PENERIMAAN -->
    <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- BAGIAN 1: DATA PELANGGAN -->
        <div class="bg-white p-6 rounded-3xl border border-gray-200/80 shadow-sm space-y-4">
            <div class="flex items-center space-x-2.5 border-b border-gray-100 pb-3">
                <div class="bg-sky-100 text-sky-600 p-2 rounded-xl text-xs">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h2 class="text-sm font-bold text-gray-900">Informasi Pelanggan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- NOMOR WHATSAPP/TELP -->
                <div>
                    <label for="customer_phone" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Nomor WhatsApp / HP <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="customer_phone" 
                        id="customer_phone" 
                        value="{{ old('customer_phone') }}" 
                        required 
                        placeholder="Contoh: 081234567890"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                </div>

                <!-- NAMA PELANGGAN -->
                <div>
                    <label for="customer_name" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Nama Lengkap Pelanggan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="customer_name" 
                        id="customer_name" 
                        value="{{ old('customer_name') }}" 
                        required 
                        placeholder="Contoh: Budi Santoso"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                </div>

                <!-- ALAMAT PELANGGAN -->
                <div class="md:col-span-2">
                    <label for="customer_address" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Alamat Singkat Pelanggan
                    </label>
                    <input 
                        type="text" 
                        name="customer_address" 
                        id="customer_address" 
                        value="{{ old('customer_address') }}" 
                        placeholder="Contoh: Jl. Raya Muara Gembong No. 12"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                </div>
            </div>
        </div>

        <!-- BAGIAN 2: DATA PERANGKAT & KELUHAN -->
        <div class="bg-white p-6 rounded-3xl border border-gray-200/80 shadow-sm space-y-4">
            <div class="flex items-center space-x-2.5 border-b border-gray-100 pb-3">
                <div class="bg-sky-100 text-sky-600 p-2 rounded-xl text-xs">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <h2 class="text-sm font-bold text-gray-900">Informasi Perangkat & Keluhan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- NAMA/TIPE PERANGKAT -->
                <div>
                    <label for="device_name" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Tipe / Merk Perangkat <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="device_name" 
                        id="device_name" 
                        value="{{ old('device_name') }}" 
                        required 
                        placeholder="Contoh: Laptop Asus ROG Strix G15"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                </div>

                <!-- NOMOR SERI -->
                <div>
                    <label for="serial_number" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Nomor Seri (Serial Number / S/N)
                    </label>
                    <input 
                        type="text" 
                        name="serial_number" 
                        id="serial_number" 
                        value="{{ old('serial_number') }}" 
                        placeholder="Opsional, contoh: SN-987654321"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                </div>

                <!-- TEKNISI PENANGGUNG JAWAB -->
                <div class="md:col-span-2">
                    <label for="technician_id" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Pilih Teknisi Penanggung Jawab
                    </label>
                    <select 
                        name="technician_id" 
                        id="technician_id" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >
                        <option value="">-- Belum Ditentukan (Pilih Nanti) --</option>
                        @foreach ($technicians as $tech)
                            <option value="{{ $tech->id }}" {{ old('technician_id') == $tech->id ? 'selected' : '' }}>
                                {{ $tech->name }} (Teknisi)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- KELUHAN UTAMA -->
                <div class="md:col-span-2">
                    <label for="complaint" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Keluhan / Kerusakan Perangkat <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="complaint" 
                        id="complaint" 
                        rows="3" 
                        required 
                        placeholder="Jelaskan detail keluhan dari pelanggan (misal: Layar blblank, mati total, overheat saat main game)"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >{{ old('complaint') }}</textarea>
                </div>

                <!-- KONDISI FISIK & KELENGKAPAN -->
                <div class="md:col-span-2">
                    <label for="conditions" class="block text-xs font-bold text-gray-700 mb-1.5">
                        Kondisi Fisik awal & Kelengkapan Unit
                    </label>
                    <textarea 
                        name="conditions" 
                        id="conditions" 
                        rows="2" 
                        placeholder="Contoh: Unit baret halus di casing B, include Charger + Tas Laptop"
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-sky-500 transition"
                    >{{ old('conditions') }}</textarea>
                </div>
            </div>
        </div>

        <!-- TOMBOL SIMPAN -->
        <div class="flex justify-end gap-3">
            <button 
                type="reset" 
                class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-gray-700 font-bold text-xs rounded-xl transition"
            >
                Reset Form
            </button>
            <button 
                type="submit" 
                class="px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs rounded-xl transition shadow-lg shadow-sky-600/20 flex items-center gap-2"
            >
                <i class="fa-solid fa-check"></i>
                <span>Simpan & Buat Tiket Servis</span>
            </button>
        </div>
    </form>

</div>
@endsection