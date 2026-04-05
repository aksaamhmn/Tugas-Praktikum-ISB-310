<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Data Category (5 Kategori)
        DB::table('categories')->insert([
            ['category_id' => 1, 'category_name' => 'Minuman Segar', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 2, 'category_name' => 'Makanan Berat', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 3, 'category_name' => 'Jajanan Pasar', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 4, 'category_name' => 'Buah-buahan', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 5, 'category_name' => 'Gorengan', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 2. Data Brand / Donatur (5 Donatur)
        DB::table('brands')->insert([
            ['brand_id' => 1, 'nama_brand' => 'Masjid Al-Ikhlas', 'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 2, 'nama_brand' => 'DKM Fasilkom', 'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 3, 'nama_brand' => 'Hamba Allah', 'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 4, 'nama_brand' => 'Warga RT 04', 'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 5, 'nama_brand' => 'Ibu-ibu PKK', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3. Inject 13 Data Product (Menu Takjil)
        DB::table('products')->insert([
            ['product_id' => 1, 'category_id' => 1, 'brand_id' => 1, 'product_name' => 'Es Pisang Ijo', 'product_price' => 15000, 'product_stock' => 50, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 2, 'category_id' => 2, 'brand_id' => 2, 'product_name' => 'Nasi Kotak Ayam', 'product_price' => 25000, 'product_stock' => 35, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 3, 'category_id' => 3, 'brand_id' => 3, 'product_name' => 'Kolak Pisang', 'product_price' => 10000, 'product_stock' => 20, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 4, 'category_id' => 4, 'brand_id' => 4, 'product_name' => 'Kurma Ajwa (Box)', 'product_price' => 45000, 'product_stock' => 15, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 5, 'category_id' => 1, 'brand_id' => 5, 'product_name' => 'Es Campur Spesial', 'product_price' => 12000, 'product_stock' => 40, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 6, 'category_id' => 5, 'brand_id' => 1, 'product_name' => 'Bakwan Sayur Hangat', 'product_price' => 2000, 'product_stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 7, 'category_id' => 2, 'brand_id' => 2, 'product_name' => 'Nasi Kuning Telur', 'product_price' => 15000, 'product_stock' => 30, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 8, 'category_id' => 3, 'brand_id' => 3, 'product_name' => 'Kue Lumpur Surga', 'product_price' => 5000, 'product_stock' => 60, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 9, 'category_id' => 5, 'brand_id' => 4, 'product_name' => 'Risoles Mayo', 'product_price' => 4000, 'product_stock' => 45, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 10, 'category_id' => 1, 'brand_id' => 5, 'product_name' => 'Sop Buah Segar', 'product_price' => 13000, 'product_stock' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 11, 'category_id' => 2, 'brand_id' => 1, 'product_name' => 'Lontong Isi Ayam', 'product_price' => 5000, 'product_stock' => 55, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 12, 'category_id' => 1, 'brand_id' => 2, 'product_name' => 'Es Teh Manis', 'product_price' => 3000, 'product_stock' => 70, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 13, 'category_id' => 3, 'brand_id' => 3, 'product_name' => 'Puding Coklat Susu', 'product_price' => 7000, 'product_stock' => 40, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
