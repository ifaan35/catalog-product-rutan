<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DummyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key constraints temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing products
        Product::truncate();
        
        // Re-enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get category IDs
        $peternakanId = Category::where('name', 'Peternakan')->first()->id;
        $perikananId = Category::where('name', 'Perikanan')->first()->id;
        $pertanianId = Category::where('name', 'Pertanian')->first()->id;

        $products = [
            // Peternakan - Telur Ayam
            [
                'name' => 'Telur Ayam Segar Grade A (1 Rak - 30 Butir)',
                'description' => 'Telur ayam ras segar langsung dari kandang peternakan RUTAN. Berkualitas tinggi, kadar kolesterol rendah, dan kaya nutrisi lengkap untuk keluarga Indonesia.',
                'price' => 65000,
                'original_price' => 75000,
                'stock' => 150,
                'image_url' => 'https://via.placeholder.com/400x300/FFD700/333333?text=Telur+Ayam+Grade+A',
                'category_id' => $peternakanId,
                'is_trending' => true,
            ],
            [
                'name' => 'Telur Ayam Organik (1 Dozen)',
                'description' => 'Telur ayam organik bebas pakan kimiawi dari peternakan RUTAN. Dipelihara dengan metode tradisional yang alami dan sehat.',
                'price' => 85000,
                'original_price' => 100000,
                'stock' => 80,
                'image_url' => 'https://via.placeholder.com/400x300/FFC700/333333?text=Telur+Organik',
                'category_id' => $peternakanId,
                'is_trending' => false,
            ],
            [
                'name' => 'Telur Ayam Kampung (Bebas Kandang)',
                'description' => 'Telur ayam kampung bebas kandang dari peternakan tradisional RUTAN. Warna kuning kecoklatan yang indah dan rasa lebih gurih.',
                'price' => 95000,
                'original_price' => 110000,
                'stock' => 60,
                'image_url' => 'https://via.placeholder.com/400x300/FFA500/333333?text=Telur+Kampung',
                'category_id' => $peternakanId,
                'is_trending' => true,
            ],

            // Perikanan - Ikan Lele
            [
                'name' => 'Ikan Lele Segar (1 Kg)',
                'description' => 'Ikan lele segar hasil budidaya kolam air tawar RUTAN. Daging lembut, tidak berbau tanah, dan kaya akan protein serta omega 3.',
                'price' => 45000,
                'original_price' => 55000,
                'stock' => 120,
                'image_url' => 'https://via.placeholder.com/400x300/4682B4/FFFFFF?text=Ikan+Lele+1Kg',
                'category_id' => $perikananId,
                'is_trending' => true,
            ],
            [
                'name' => 'Ikan Lele Premium Grade (1.5 Kg)',
                'description' => 'Ikan lele premium pilihan ukuran besar dari budidaya RUTAN. Daging tebal dan padat, sempurna untuk kebutuhan keluarga besar.',
                'price' => 65000,
                'original_price' => 80000,
                'stock' => 90,
                'image_url' => 'https://via.placeholder.com/400x300/4169E1/FFFFFF?text=Ikan+Lele+Premium',
                'category_id' => $perikananId,
                'is_trending' => false,
            ],
            [
                'name' => 'Ikan Lele Filet (Tanpa Kepala)',
                'description' => 'Ikan lele yang sudah di-filet tanpa kepala dari perikanan RUTAN. Praktis untuk dimasak dan hemat waktu dalam persiapan masakan.',
                'price' => 55000,
                'original_price' => 65000,
                'stock' => 70,
                'image_url' => 'https://via.placeholder.com/400x300/1E90FF/FFFFFF?text=Ikan+Lele+Filet',
                'category_id' => $perikananId,
                'is_trending' => false,
            ],

            // Pertanian - Arang
            [
                'name' => 'Arang Batok Kelapa Premium (1 Kg)',
                'description' => 'Arang batok kelapa berkualitas tinggi dari pertanian RUTAN. Panas tahan lama, minim asap, dan cocok untuk memanggang ikan maupun daging.',
                'price' => 12000,
                'original_price' => 15000,
                'stock' => 300,
                'image_url' => 'https://via.placeholder.com/400x300/2C2C2C/FFFFFF?text=Arang+Batok+1Kg',
                'category_id' => $pertanianId,
                'is_trending' => true,
            ],
            [
                'name' => 'Arang Kayu Bakar (5 Kg)',
                'description' => 'Arang kayu bakar berkualitas dari hutan lestari RUTAN. Nyala api stabil dan tahan lama hingga 8 jam untuk acara outdoor.',
                'price' => 50000,
                'original_price' => 60000,
                'stock' => 100,
                'image_url' => 'https://via.placeholder.com/400x300/1C1C1C/FFFFFF?text=Arang+Kayu+5Kg',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],
            [
                'name' => 'Arang Aktif Filtrasi (500 Gram)',
                'description' => 'Arang aktif hasil olahan dari bahan baku pertanian RUTAN. Cocok untuk penyaringan air dan berbagai kebutuhan industri kecil.',
                'price' => 25000,
                'original_price' => 30000,
                'stock' => 80,
                'image_url' => 'https://via.placeholder.com/400x300/3C3C3C/FFFFFF?text=Arang+Aktif',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],

            // Pertanian - Cabai
            [
                'name' => 'Cabai Merah Segar (500g)',
                'description' => 'Cabai merah segar dari pertanian RUTAN. Pedas, aromatis, dan cocok untuk berbagai olahan masakan tradisional Indonesia.',
                'price' => 18000,
                'original_price' => 22000,
                'stock' => 200,
                'image_url' => 'https://via.placeholder.com/400x300/DC143C/FFFFFF?text=Cabai+Merah',
                'category_id' => $pertanianId,
                'is_trending' => true,
            ],
            [
                'name' => 'Cabai Rawit Pedas (250g)',
                'description' => 'Cabai rawit pilihan dengan tingkat kepedasan optimal dari pertanian RUTAN. Sempurna untuk membuat sambal atau tumisan yang nikmat.',
                'price' => 15000,
                'original_price' => 18000,
                'stock' => 150,
                'image_url' => 'https://via.placeholder.com/400x300/FF0000/FFFFFF?text=Cabai+Rawit',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],
            [
                'name' => 'Cabai Hijau Segar (500g)',
                'description' => 'Cabai hijau segar dari kebun RUTAN. Rasa pedas-segar dengan aroma yang wangi, cocok untuk masakan nusantara.',
                'price' => 16000,
                'original_price' => 20000,
                'stock' => 180,
                'image_url' => 'https://via.placeholder.com/400x300/228B22/FFFFFF?text=Cabai+Hijau',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],

            // Pertanian - Bakpia
            [
                'name' => 'Bakpia Kacang Hijau (Isi 10 Pcs)',
                'description' => 'Bakpia lembut dengan isian kacang hijau manis dari RUTAN. Cocok menjadi oleh-oleh keluarga dengan cita rasa otentik tradisional.',
                'price' => 22000,
                'original_price' => 27000,
                'stock' => 100,
                'image_url' => 'https://via.placeholder.com/400x300/8B7355/FFFFFF?text=Bakpia+Kacang',
                'category_id' => $pertanianId,
                'is_trending' => true,
            ],
            [
                'name' => 'Bakpia Cokelat Premium (Isi 12 Pcs)',
                'description' => 'Bakpia dengan isian cokelat premium dari RUTAN. Rasa manis gurih yang sempurna dan kemasan menarik untuk hadiah.',
                'price' => 35000,
                'original_price' => 42000,
                'stock' => 60,
                'image_url' => 'https://via.placeholder.com/400x300/8B4513/FFFFFF?text=Bakpia+Cokelat',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],
            [
                'name' => 'Bakpia Kacang Tanah (Isi 15 Pcs)',
                'description' => 'Bakpia lezat dengan isian kacang tanah pilihan dari produsen RUTAN. Gurih dan cocok dimakan sebagai camilan atau hadiah spesial.',
                'price' => 25000,
                'original_price' => 30000,
                'stock' => 90,
                'image_url' => 'https://via.placeholder.com/400x300/8B6F47/FFFFFF?text=Bakpia+Kacang+Tanah',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],

            // Pertanian - Sabun Cuci Piring
            [
                'name' => 'Sabun Cuci Piring Jeruk Nipis (500ml)',
                'description' => 'Sabun cuci piring dari RUTAN dengan aroma jeruk nipis yang segar. Ampuh menghilangkan lemak membandel dan ramah lingkungan.',
                'price' => 14000,
                'original_price' => 18000,
                'stock' => 250,
                'image_url' => 'https://via.placeholder.com/400x300/32CD32/333333?text=Sabun+Jeruk+500ml',
                'category_id' => $pertanianId,
                'is_trending' => true,
            ],
            [
                'name' => 'Sabun Cuci Piring Lemon Fresh (1 Liter)',
                'description' => 'Sabun cuci piring dengan ukuran ekonomis dari RUTAN. Daya bersih maksimal dengan aroma lemon yang tahan lama di piring Anda.',
                'price' => 24000,
                'original_price' => 30000,
                'stock' => 180,
                'image_url' => 'https://via.placeholder.com/400x300/FFD700/333333?text=Sabun+1Liter',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],
            [
                'name' => 'Sabun Cuci Piring Aroma Bunga (500ml)',
                'description' => 'Sabun cuci piring premium dengan aroma bunga yang harum dari RUTAN. Formula khusus yang lembut di tangan namun efektif mencuci piring.',
                'price' => 16000,
                'original_price' => 20000,
                'stock' => 150,
                'image_url' => 'https://via.placeholder.com/400x300/FF69B4/FFFFFF?text=Sabun+Bunga',
                'category_id' => $pertanianId,
                'is_trending' => false,
            ],
        ];

        // Insert all products
        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Successfully created ' . count($products) . ' dummy products!');
    }
}
