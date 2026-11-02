@extends('layouts.admin')

@section('title', 'Manajemen Staf & Pengguna')

@section('content')
<div class="space-y-6">

    <!-- ALERT SUCCESS / ERROR -->
    @if (session('status'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm rounded-2xl font-semibold space-y-1">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base"></i>
                <span>Terjadi kesalahan input data:</span>
            </div>
            <ul class="list-disc list-inside text-xs pl-6 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- HEADER & AKSI TAMBAH -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Manajemen Staf & Akun</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola data pengguna, hak akses role, dan status aktif akun staf toko.</p>
        </div>

        <button onclick="openCreateModal()" class="px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-user-plus"></i>
            <span>Tambah Staf Baru</span>
        </button>
    </div>

    <!-- TABEL DATA USER -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden p-6 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                        <th class="py-3 px-4 rounded-l-xl">Nama Lengkap</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Role Akses</th>
                        <th class="py-3 px-4">Status Akun</th>
                        <th class="py-3 px-4">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900 flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-black text-xs uppercase">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <span>{{ $user->name }}</span>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-600">
                                {{ $user->email }}
                            </td>
                            <td class="py-3.5 px-4">
                                @php
                                    $roleClasses = [
                                        'owner'   => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'admin'   => 'bg-sky-50 text-sky-700 border-sky-200',
                                        'teknisi' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 border rounded-lg text-[10px] font-black uppercase tracking-wider {{ $roleClasses[$user->role] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                @if ($user->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-black rounded-lg uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-black rounded-lg uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Nonaktif</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-500">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- TOMBOL EDIT MODAL -->
                                    <button onclick="openEditModal({{ json_encode($user) }})" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition cursor-pointer" title="Edit Staf">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    @if (auth()->id() !== $user->id)
                                        <!-- TOMBOL TOGGLE STATUS -->
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah status akun ini?')" class="p-2 {{ $user->is_active ? 'bg-amber-50 hover:bg-amber-100 text-amber-600' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-600' }} rounded-xl transition cursor-pointer" title="{{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                                <i class="fa-solid {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                            </button>
                                        </form>

                                        <!-- TOMBOL HAPUS STAF -->
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus staf {{ $user->name }}? Tindakan ini tidak dapat dibatalkan!')" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl transition cursor-pointer" title="Hapus Staf">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-400 text-xs">Belum ada data staf terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">
            {{ $users->links() }}
        </div>
    </div>

</div>

<!-- MODAL POP-UP CREATE STAF -->
<div id="createModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-md w-full overflow-hidden p-6 space-y-4 transform transition-all">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-black text-slate-900">Tambah Staf Baru</h3>
            <button onclick="closeCreateModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-3.5">
            @csrf

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Budi Santoso" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Alamat Email</label>
                <input type="email" name="email" required placeholder="staf@indrajaya.com" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Role Akses Sistem</label>
                <select name="role" required class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    <option value="">-- Pilih Role Akses --</option>
                    <option value="teknisi">Teknisi Servis</option>
                    <option value="admin">Admin / Kasir Toko</option>
                    <option value="owner">Owner / Pemilik Toko</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Kata Sandi (Password)</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 cursor-pointer">
                    Simpan Staf
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL POP-UP EDIT STAF -->
<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-md w-full overflow-hidden p-6 space-y-4 transform transition-all">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-black text-slate-900">Edit Data Staf</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-3.5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Nama Lengkap</label>
                <input type="text" id="edit_name" name="name" required class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Alamat Email</label>
                <input type="email" id="edit_email" name="email" required class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Role Akses Sistem</label>
                <select id="edit_role" name="role" required class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    <option value="teknisi">Teknisi Servis</option>
                    <option value="admin">Admin / Kasir Toko</option>
                    <option value="owner">Owner / Pemilik Toko</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Ubah Kata Sandi (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah..." class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 cursor-pointer">
                    Update Staf
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Functions Create Modal
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    // Functions Edit Modal
    function openEditModal(user) {
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        
        // Dynamically set form action
        document.getElementById('editForm').action = `/admin/users/${user.id}`;
        
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection