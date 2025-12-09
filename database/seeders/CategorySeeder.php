<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Peternakan',
                'description' => 'Produk-produk hasil peternakan yang dikelola oleh warga binaan'
            ],
            [
                'name' => 'Perikanan', 
                'description' => 'Produk-produk hasil perikanan yang dibudidayakan oleh warga binaan'
            ],
            [
                'name' => 'Pertanian',
                'description' => 'Produk-produk hasil pertanian yang ditanam dan dikelola oleh warga binaan'
            ],
            [
                'name' => 'Makanan Olahan',
                'description' => 'Produk makanan olahan berkualitas yang diproses oleh warga binaan dengan standar kebersihan tinggi'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
