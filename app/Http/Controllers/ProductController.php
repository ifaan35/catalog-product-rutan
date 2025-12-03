<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of all products
     */
    public function index()
    {
        $products = Product::paginate(12);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        // Temukan produk berdasarkan ID. 
        // Jika ID tidak valid atau produk tidak ada, Laravel akan melempar 404.
        $product = Product::findOrFail($id); 
        
        // Ambil produk serupa untuk rekomendasi (3 produk lain)
        $relatedProducts = Product::where('id', '!=', $product->id)
                                  ->limit(3)
                                  ->get();
        
        // Kirim data ke view
        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Display products by category
     */
    public function category($category)
    {
        // Cari kategori berdasarkan slug atau name
        $categoryModel = Category::where('slug', $category)
                                ->orWhere('name', $category)
                                ->firstOrFail();
        
        $products = Product::where('category_id', $categoryModel->id)->paginate(12);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'))->with('currentCategory', $categoryModel->name);
    }

    /**
     * Search products
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Product::where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->orWhereHas('category', function($q) use ($query) {
                              $q->where('name', 'LIKE', "%{$query}%");
                          })
                          ->paginate(12);
        
        $categories = Category::all();
        return view('products.search', compact('products', 'categories', 'query'));
    }
}
