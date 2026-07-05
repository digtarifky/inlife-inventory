<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
   public function run(): void
    {
        Product::updateOrCreate(
            ['code' => 'INV-ELK-001'],
            [
                'category_id' => 1,
                'name' => 'Laptop Asus ROG Zephyrus', 
                'stock' => 10, 
                'storage_location' => 'Ruang IT Lantai 2',
                'condition' => 'Bagus',
                'description' => 'Laptop operasional untuk divisi desain dan IT.'
            ]
        );

        Product::updateOrCreate(
            ['code' => 'INV-FTR-001'],
            [
                'category_id' => 2, 
                'name' => 'Kursi Kantor', 
                'stock' => 200, 
                'storage_location' => 'Gudang Logistik Utama', 
                'condition' => 'Bagus',
                'description' => 'Kursi hidrolik warna hitam.'
            ]
        );
        
        Product::updateOrCreate(
            ['code' => 'INV-ELK-002'],
            [
                'category_id' => 1, 
                'name' => 'Proyektor Epson', 
                'stock' => 6, 
                'storage_location' => 'Ruang Rapat Eksekutif', 
                'condition' => 'Rusak Ringan',
                'description' => 'Lampu mulai redup, butuh maintenance.'
            ]
        );
    }
}