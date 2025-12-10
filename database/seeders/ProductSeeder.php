<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel produk dulu agar tidak duplikat saat di-seed ulang
        // Hapus dengan cara yang aman karena ada foreign key constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = [
            [
                'name' => 'Amplang Ikan Tenggiri Khas Rutan',
                'price' => 25000,
                'original_price' => 30000,
                'description' => 'Cemilan kerupuk ikan asli yang gurih dan renyah. Diproduksi higienis oleh unit boga Rutan.',
                'stock' => 50,
                'image' => 'products/8L2mGw7TzpViBOGxXyiRakgyBXK4CXSJqgspyVZN.png',
                'category_id' => null,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Telur Ayam Segar Grade A (1 Rak)',
                'price' => 55000,
                'original_price' => 60000,
                'description' => 'Telur ayam ras segar langsung dari unit peternakan Rutan. Kualitas terjamin dan tinggi protein.',
                'stock' => 100,
                'image' => 'products/EA7z7mRWThYqKi9i0hBgODaUOMRrv09R5bhyuZ50.jpg',
                'category_id' => null,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bakpia Pathok Rutan (Isi 10)',
                'price' => 20000,
                'original_price' => 25000,
                'description' => 'Bakpia lembut dengan isian kacang hijau yang manis dan legit. Cocok untuk oleh-oleh.',
                'stock' => 30,
                'image' => 'products/EoknSXNchawGFcPH9WmP1Z3KwIpuhtCjCwUoVz6Q.jpg',
                'category_id' => null,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arang Batok Kelapa (1 Kg)',
                'price' => 10000,
                'original_price' => 12000,
                'description' => 'Arang kualitas super, panas tahan lama, dan minim asap. Cocok untuk memanggang.',
                'stock' => 200,
                'image' => 'products/jA81IbvCFFcr5evU4B0F5DEyPby2lRFOSk06plGc.jpg',
                'category_id' => null,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sabun Cuci Piring (Botol 500ml)',
                'price' => 12000,
                'original_price' => 15000,
                'description' => 'Sabun cuci piring ampuh angkat lemak dengan aroma jeruk nipis yang segar.',
                'stock' => 80,
                'image' => 'products/pHGBW20kRvIXCmV4XXpcJkpjU8sPLF7FfkhKHLCZ.jpg',
                'category_id' => null,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ikan Nila Segar (1 Kg)',
                'price' => 35000,
                'original_price' => 40000,
                'description' => 'Ikan Nila segar hasil budidaya kolam air tawar Rutan. Daging manis dan tidak bau tanah.',
                'stock' => 40,
                'image' => 'products/pybb7BRK5wTgamAQiGB3AK6lPgOaXtFIhuJDunu5.jpg',
                'category_id' => null,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keripik Tempe Original (250g)',
                'price' => 15000,
                'original_price' => 18000,
                'description' => 'Keripik tempe renyah dengan bumbu rahasia khas Rutan. Camilan sehat tinggi protein.',
                'stock' => 60,
                'image' => 'products/qcheK5dQY0TvVwFq50fSE9IhMsmFvb4MXVJjVcMh.png',
                'category_id' => null,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minyak Kelapa Murni (500ml)',
                'price' => 45000,
                'original_price' => 50000,
                'description' => 'Virgin coconut oil (VCO) murni tanpa bahan kimia. Baik untuk masak dan kesehatan.',
                'stock' => 25,
                'image' => 'products/YdWmPhnic7PBTEstU4z2IyAgpWbWwYgkX5LKnN7e.jpg',
                'category_id' => null,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}

