<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get trending/featured products (latest 8 products)
        $trendingProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        
        // Get all categories for quick navigation
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();
        
        return view('home', compact('trendingProducts', 'categories'));
    }
}
