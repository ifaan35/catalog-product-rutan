<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Mengambil produk trending dari database
            $trendingProducts = Product::where('is_trending', true)->take(4)->get();
            
            // Jika tidak ada produk trending, ambil produk terbaru
            if ($trendingProducts->isEmpty()) {
                $trendingProducts = Product::latest()->take(4)->get();
            }
            
            // Mengambil kategori untuk quick categories
            $categories = Category::all();
            
            return view('home', compact('trendingProducts', 'categories'));
        } catch (\Exception $e) {
            // Fallback jika ada error database
            $trendingProducts = collect();
            $categories = collect();
            
            return view('home', compact('trendingProducts', 'categories'));
        }
    }
}
