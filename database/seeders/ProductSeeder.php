<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kita sudah punya kategori ID 1 (misal: Elektronik)
        Product::updateOrCreate(
            ['code' => 'INV-ELK-001'],
            [
                'category_id' => 1, 
                'name' => 'Laptop Asus ROG Zephyrus', 
                'stock' => 5, 
                'description' => 'Laptop operasional untuk divisi desain dan IT.'
            ]
        );

        Product::updateOrCreate(
            ['code' => 'INV-ELK-002'],
            [
                'category_id' => 1, 
                'name' => 'Proyektor Epson', 
                'stock' => 2, 
                'description' => 'Proyektor untuk kebutuhan rapat di ruang utama.'
            ]
        );
    }
}