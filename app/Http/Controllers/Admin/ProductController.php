<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        $editingProduct = old('form_type') === 'edit'
            ? Product::find(old('product_id'))
            : null;

        return view('admin.product.index', compact('products', 'editingProduct'));
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.products.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:products,code'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cost_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ]);

        $image = $validated['image'];
        unset($validated['image']);
        $validated['image_path'] = $this->storeImage($image);

        Product::create([...$validated, 'is_active' => true]);

        return redirect()->route('admin.products.index')
            ->with('status', 'Produk baru berhasil ditambahkan!');
    }

    public function edit(Product $product): RedirectResponse
    {
        return redirect()->route('admin.products.index');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique('products', 'code')->ignore($product->getKey())],
            'name' => ['required', 'string', 'max:255'],
            'image' => [Rule::requiredIf(blank($product->image_path)), 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cost_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ]);

        $image = $validated['image'] ?? null;
        unset($validated['image']);

        if ($image !== null) {
            $oldImagePath = $product->image_path;
            $validated['image_path'] = $this->storeImage($image);
            $product->update($validated);

            if ($oldImagePath !== null) {
                Storage::disk('public')->delete($oldImagePath);
            }
        } else {
            $product->update($validated);
        }

        return redirect()->route('admin.products.index')
            ->with('status', 'Data produk berhasil diperbarui!');
    }

    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->update(['is_active' => ! $product->is_active]);

        $statusText = $product->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()->with('status', "Produk {$product->name} berhasil {$statusText}.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->serviceSpareparts()->exists()) {
            return redirect()->back()->withErrors([
                'error' => "Produk {$product->name} tidak dapat dihapus karena sudah tercatat pada riwayat servis. Nonaktifkan produk jika tidak digunakan lagi.",
            ]);
        }

        $imagePath = $product->image_path;
        $product->delete();

        if ($imagePath !== null) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->route('admin.products.index')
            ->with('status', 'Data produk berhasil dihapus.');
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('products', 'public');

        if ($path === false) {
            throw new RuntimeException('Gambar produk gagal disimpan.');
        }

        return $path;
    }
}
