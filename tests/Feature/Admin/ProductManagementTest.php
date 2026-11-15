<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_owner_can_manage_products_from_the_index_page(): void
    {
        Storage::fake('public');

        $this->actingAs(User::create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => 'password',
            'role' => 'owner',
            'is_active' => true,
        ]));

        $this->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee('Manajemen Produk')
            ->assertSee('Tambah Produk Baru');

        $this->post(route('admin.products.store'), [
            'code' => 'SP-SSD-256',
            'name' => 'SSD NVMe 256GB',
            'cost_price' => 300000,
            'selling_price' => 450000,
            'stock' => 10,
            'min_stock' => 2,
            'image' => UploadedFile::fake()->image('ssd.jpg'),
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::where('code', 'SP-SSD-256')->firstOrFail();
        $this->assertTrue($product->is_active);
        $originalImagePath = $product->image_path;
        Storage::disk('public')->assertExists($originalImagePath);

        $this->put(route('admin.products.update', $product), [
            'code' => 'SP-SSD-512',
            'name' => 'SSD NVMe 512GB',
            'cost_price' => 500000,
            'selling_price' => 700000,
            'stock' => 5,
            'min_stock' => 1,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'code' => 'SP-SSD-512',
            'name' => 'SSD NVMe 512GB',
        ]);
        $this->assertSame($originalImagePath, $product->fresh()->image_path);
        Storage::disk('public')->assertExists($originalImagePath);

        $this->put(route('admin.products.update', $product), [
            'code' => 'SP-SSD-512',
            'name' => 'SSD NVMe 512GB',
            'cost_price' => 500000,
            'selling_price' => 700000,
            'stock' => 5,
            'min_stock' => 1,
            'image' => UploadedFile::fake()->image('ssd-updated.webp'),
        ])->assertRedirect(route('admin.products.index'));

        $updatedImagePath = $product->fresh()->image_path;
        $this->assertNotSame($originalImagePath, $updatedImagePath);
        Storage::disk('public')->assertExists($updatedImagePath);
        Storage::disk('public')->assertMissing($originalImagePath);

        $this->patch(route('admin.products.toggle-status', $product))
            ->assertRedirect();
        $this->assertDatabaseHas('products', ['id' => $product->id, 'is_active' => false]);

        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($updatedImagePath);
    }

    public function test_technicians_cannot_access_product_management(): void
    {
        $this->actingAs(User::create([
            'name' => 'Technician',
            'email' => 'technician@example.test',
            'password' => 'password',
            'role' => 'teknisi',
            'is_active' => true,
        ]));

        $this->get(route('admin.products.index'))->assertForbidden();
    }

    public function test_product_creation_requires_an_image(): void
    {
        $this->actingAs(User::create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => 'password',
            'role' => 'owner',
            'is_active' => true,
        ]));

        $this->from(route('admin.products.index'))
            ->post(route('admin.products.store'), [
                'code' => 'SP-SSD-256',
                'name' => 'SSD NVMe 256GB',
                'cost_price' => 300000,
                'selling_price' => 450000,
                'stock' => 10,
                'min_stock' => 2,
            ])
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('products', 0);
    }

    public function test_product_creation_rejects_unsupported_image_formats(): void
    {
        $this->actingAs(User::create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => 'password',
            'role' => 'owner',
            'is_active' => true,
        ]));

        $this->from(route('admin.products.index'))
            ->post(route('admin.products.store'), [
                'code' => 'SP-SSD-256',
                'name' => 'SSD NVMe 256GB',
                'cost_price' => 300000,
                'selling_price' => 450000,
                'stock' => 10,
                'min_stock' => 2,
                'image' => UploadedFile::fake()->create('manual.txt', 10, 'text/plain'),
            ])
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('products', 0);
    }

    public function test_product_creation_rejects_images_over_two_megabytes(): void
    {
        $this->actingAs(User::create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => 'password',
            'role' => 'owner',
            'is_active' => true,
        ]));

        $this->from(route('admin.products.index'))
            ->post(route('admin.products.store'), [
                'code' => 'SP-SSD-256',
                'name' => 'SSD NVMe 256GB',
                'cost_price' => 300000,
                'selling_price' => 450000,
                'stock' => 10,
                'min_stock' => 2,
                'image' => UploadedFile::fake()->image('large.jpg')->size(2049),
            ])
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('products', 0);
    }

    public function test_legacy_product_without_image_requires_one_when_edited(): void
    {
        $this->actingAs(User::create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => 'password',
            'role' => 'owner',
            'is_active' => true,
        ]));

        $product = Product::create([
            'code' => 'SP-SSD-256',
            'name' => 'SSD NVMe 256GB',
            'cost_price' => 300000,
            'selling_price' => 450000,
            'stock' => 10,
            'min_stock' => 2,
            'is_active' => true,
        ]);

        $this->from(route('admin.products.index'))
            ->put(route('admin.products.update', $product), [
                'code' => 'SP-SSD-512',
                'name' => 'SSD NVMe 512GB',
                'cost_price' => 500000,
                'selling_price' => 700000,
                'stock' => 5,
                'min_stock' => 1,
            ])
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHasErrors('image');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'code' => 'SP-SSD-256',
            'image_path' => null,
        ]);
    }
}
