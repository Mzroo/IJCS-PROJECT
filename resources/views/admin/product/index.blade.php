@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="space-y-6">
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

    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Manajemen Produk</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola data produk, harga, stok, dan status ketersediaan produk.</p>
        </div>
        <button onclick="openCreateModal()" class="px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-box-open"></i>
            <span>Tambah Produk Baru</span>
        </button>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden p-6 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                        <th class="py-3 px-4 rounded-l-xl">Gambar</th>
                        <th class="py-3 px-4">Kode / Nama Produk</th>
                        <th class="py-3 px-4">Harga Modal</th>
                        <th class="py-3 px-4">Harga Jual</th>
                        <th class="py-3 px-4">Stok</th>
                        <th class="py-3 px-4">Status Produk</th>
                        <th class="py-3 px-4">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4">
                                @if ($product->image_path)
                                    <img src="{{ Storage::disk('public')->url($product->image_path) }}" alt="Gambar {{ $product->name }}" class="w-12 h-12 object-cover rounded-xl border border-slate-200">
                                @else
                                    <div class="w-12 h-12 rounded-xl border border-slate-200 bg-slate-50 text-slate-400 flex items-center justify-center" title="Belum ada gambar">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-black text-slate-900">{{ $product->name }}</div>
                                <div class="text-[10px] font-bold text-slate-400 mt-1">{{ $product->code }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-600">Rp {{ number_format((float) $product->cost_price, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-4 font-bold text-slate-700">Rp {{ number_format((float) $product->selling_price, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-4">
                                <span class="font-black {{ $product->stock <= $product->min_stock ? 'text-rose-600' : 'text-slate-700' }}">{{ $product->stock }}</span>
                                <span class="text-slate-400">/ min. {{ $product->min_stock }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                @if ($product->is_active)
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
                            <td class="py-3.5 px-4 font-medium text-slate-500">{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openEditModal({{ Js::from($product) }})" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition cursor-pointer" title="Edit Produk">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.products.toggle-status', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah status produk ini?')" class="p-2 {{ $product->is_active ? 'bg-amber-50 hover:bg-amber-100 text-amber-600' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-600' }} rounded-xl transition cursor-pointer" title="{{ $product->is_active ? 'Nonaktifkan Produk' : 'Aktifkan Produk' }}">
                                            <i class="fa-solid {{ $product->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan!')" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl transition cursor-pointer" title="Hapus Produk">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                                <p class="font-bold">Belum ada data produk.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="pt-4">{{ $products->links() }}</div>
        @endif
    </div>
</div>

<div id="createModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-black text-slate-900">Tambah Produk Baru</h3>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            @csrf
            <input type="hidden" name="form_type" value="create">
            <div>
                <label for="create_code" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Kode Produk</label>
                <input id="create_code" type="text" name="code" required maxlength="255" placeholder="Contoh: SP-SSD-256" value="{{ old('form_type') === 'create' ? old('code') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="create_name" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Nama Produk</label>
                <input id="create_name" type="text" name="name" required maxlength="255" placeholder="Nama produk" value="{{ old('form_type') === 'create' ? old('name') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div class="sm:col-span-2 flex flex-col items-center text-center">
                <label for="create_image" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Gambar Produk <span class="text-rose-600">*</span></label>
                <input id="create_image" type="file" name="image" required accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="w-full max-w-md text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
                <p class="text-[10px] text-slate-500 mt-1">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</p>
                <img id="create_image_preview" class="hidden mt-2 w-24 h-24 object-cover rounded-xl border border-slate-200" alt="Pratinjau gambar produk">
            </div>
            <div>
                <label for="create_cost_price" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Harga Modal</label>
                <input id="create_cost_price" type="number" name="cost_price" required min="0" step="0.01" value="{{ old('form_type') === 'create' ? old('cost_price') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="create_selling_price" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Harga Jual</label>
                <input id="create_selling_price" type="number" name="selling_price" required min="0" step="0.01" value="{{ old('form_type') === 'create' ? old('selling_price') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="create_stock" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Stok</label>
                <input id="create_stock" type="number" name="stock" required min="0" step="1" value="{{ old('form_type') === 'create' ? old('stock', 0) : 0 }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="create_min_stock" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Batas Stok Minimum</label>
                <input id="create_min_stock" type="number" name="min_stock" required min="0" step="1" value="{{ old('form_type') === 'create' ? old('min_stock', 2) : 2 }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div class="sm:col-span-2 pt-2 flex items-center justify-end gap-2">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 cursor-pointer">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-black text-slate-900">Edit Data Produk</h3>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="edit">
            <input type="hidden" id="edit_product_id" name="product_id" value="{{ old('form_type') === 'edit' ? old('product_id') : '' }}">
            <div>
                <label for="edit_code" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Kode Produk</label>
                <input id="edit_code" type="text" name="code" required maxlength="255" value="{{ old('form_type') === 'edit' ? old('code') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="edit_name" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Nama Produk</label>
                <input id="edit_name" type="text" name="name" required maxlength="255" value="{{ old('form_type') === 'edit' ? old('name') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div class="sm:col-span-2 flex flex-col items-center text-center">
                <label for="edit_image" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Gambar Produk</label>
                <img id="edit_image_preview" class="hidden mb-2 w-24 h-24 object-cover rounded-xl border border-slate-200" alt="Gambar produk saat ini">
                <div id="edit_no_image" class="hidden mb-2 w-24 h-24 rounded-xl border border-slate-200 bg-slate-50 text-slate-400 items-center justify-center">
                    <i class="fa-solid fa-image"></i>
                </div>
                <input id="edit_image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="w-full max-w-md text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
                <p id="edit_image_help" class="text-[10px] text-slate-500 mt-1">Kosongkan jika ingin tetap menggunakan gambar saat ini. Format JPG, PNG, atau WEBP; maksimal 2 MB.</p>
            </div>
            <div>
                <label for="edit_cost_price" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Harga Modal</label>
                <input id="edit_cost_price" type="number" name="cost_price" required min="0" step="0.01" value="{{ old('form_type') === 'edit' ? old('cost_price') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="edit_selling_price" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Harga Jual</label>
                <input id="edit_selling_price" type="number" name="selling_price" required min="0" step="0.01" value="{{ old('form_type') === 'edit' ? old('selling_price') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="edit_stock" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Stok</label>
                <input id="edit_stock" type="number" name="stock" required min="0" step="1" value="{{ old('form_type') === 'edit' ? old('stock') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div>
                <label for="edit_min_stock" class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Batas Stok Minimum</label>
                <input id="edit_min_stock" type="number" name="min_stock" required min="0" step="1" value="{{ old('form_type') === 'edit' ? old('min_stock') : '' }}" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <div class="sm:col-span-2 pt-2 flex items-center justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 cursor-pointer">Update Produk</button>
            </div>
        </form>
    </div>
</div>

<script>
    const publicStorageUrl = {{ Js::from(rtrim(Storage::disk('public')->url(''), '/')) }};
    let editImageUrl = null;
    let editImagePreviewObjectUrl = null;

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(product) {
        document.getElementById('edit_code').value = product.code;
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_cost_price').value = product.cost_price;
        document.getElementById('edit_selling_price').value = product.selling_price;
        document.getElementById('edit_stock').value = product.stock;
        document.getElementById('edit_min_stock').value = product.min_stock;
        document.getElementById('edit_product_id').value = product.id;
        document.getElementById('editForm').action = `{{ url('/admin/products') }}/${product.id}`;
        setEditImagePreview(product.image_path ? `${publicStorageUrl}/${product.image_path}` : null);
        document.getElementById('editModal').classList.remove('hidden');
    }

    function setEditImagePreview(imageUrl) {
        const preview = document.getElementById('edit_image_preview');
        const noImage = document.getElementById('edit_no_image');
        const imageInput = document.getElementById('edit_image');
        const imageHelp = document.getElementById('edit_image_help');

        if (editImagePreviewObjectUrl) {
            URL.revokeObjectURL(editImagePreviewObjectUrl);
            editImagePreviewObjectUrl = null;
        }

        editImageUrl = imageUrl;
        imageInput.required = !imageUrl;
        preview.classList.toggle('hidden', !imageUrl);
        noImage.classList.toggle('hidden', Boolean(imageUrl));
        noImage.classList.toggle('flex', !imageUrl);
        imageHelp.textContent = imageUrl
            ? 'Kosongkan jika ingin tetap menggunakan gambar saat ini. Format JPG, PNG, atau WEBP; maksimal 2 MB.'
            : 'Gambar wajib diunggah untuk produk yang belum memiliki gambar. Format JPG, PNG, atau WEBP; maksimal 2 MB.';

        if (imageUrl) {
            preview.src = imageUrl;
        } else {
            preview.removeAttribute('src');
        }
    }

    document.getElementById('create_image').addEventListener('change', (event) => {
        const [image] = event.target.files;
        const preview = document.getElementById('create_image_preview');

        if (image) {
            preview.src = URL.createObjectURL(image);
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
            preview.removeAttribute('src');
        }
    });

    document.getElementById('edit_image').addEventListener('change', (event) => {
        const [image] = event.target.files;
        const preview = document.getElementById('edit_image_preview');
        const noImage = document.getElementById('edit_no_image');
        const imageHelp = document.getElementById('edit_image_help');

        if (editImagePreviewObjectUrl) {
            URL.revokeObjectURL(editImagePreviewObjectUrl);
            editImagePreviewObjectUrl = null;
        }

        if (image) {
            editImagePreviewObjectUrl = URL.createObjectURL(image);
            preview.src = editImagePreviewObjectUrl;
            preview.classList.remove('hidden');
            noImage.classList.add('hidden');
            noImage.classList.remove('flex');
            imageHelp.textContent = 'Pratinjau gambar baru. Gambar ini akan menggantikan gambar produk saat disimpan.';
            return;
        }

        setEditImagePreview(editImageUrl);
    });

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    @if (old('form_type') === 'create')
        openCreateModal();
    @elseif (old('form_type') === 'edit' && old('product_id'))
        setEditImagePreview({{ Js::from($editingProduct?->image_path ? Storage::disk('public')->url($editingProduct->image_path) : null) }});
        document.getElementById('editForm').action = `{{ url('/admin/products') }}/{{ old('product_id') }}`;
        document.getElementById('editModal').classList.remove('hidden');
    @endif
</script>
@endsection