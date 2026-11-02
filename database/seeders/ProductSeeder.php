<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'code' => 'SP-SSD-256',
            'name' => 'SSD NVMe 256GB M.2',
            'cost_price' => 300000.00,
            'selling_price' => 450000.00,
            'stock' => 10,
            'min_stock' => 2,
            'is_active' => true,
        ]);

        Product::create([
            'code' => 'SP-RAM-8GB',
            'name' => 'RAM DDR4 8GB Sodimm 3200MHz',
            'cost_price' => 250000.00,
            'selling_price' => 380000.00,
            'stock' => 15,
            'min_stock' => 3,
            'is_active' => true,
        ]);

        Product::create([
            'code' => 'SP-LCD-14FHD',
            'name' => 'LCD 14.0 Inch Full HD Slim 30 Pin',
            'cost_price' => 650000.00,
            'selling_price' => 850000.00,
            'stock' => 5,
            'min_stock' => 1,
            'is_active' => true,
        ]);
    }
}