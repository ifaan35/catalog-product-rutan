<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class UpdateExistingProductsCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dapatkan kategori-kategori yang ada
        $peternakan = Category::where('name', 'Peternakan')->first();
        $perikanan = Category::where('name', 'Perikanan')->first();
        $pertanian = Category::where('name', 'Pertanian')->first();

        // Update produk-produk berdasarkan kategori lama (string)
        if ($peternakan) {
            Product::where('category', 'Peternakan')->update(['category_id' => $peternakan->id]);
        }
        
        if ($perikanan) {
            Product::where('category', 'Perikanan')->update(['category_id' => $perikanan->id]);
        }
        
        if ($pertanian) {
            Product::where('category', 'Pertanian')->update(['category_id' => $pertanian->id]);
        }

        echo "Successfully updated existing products with proper categories!\n";
    }
}
