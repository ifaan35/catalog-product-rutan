<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar semua produk.
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Tampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database (termasuk upload gambar).
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            // Gambar: maks 2MB, harus jpg, jpeg, atau png
            'image' => 'nullable|image|max:2048', 
        ]);

        $validatedData['image'] = null;

        if ($request->hasFile('image')) {
            // Simpan gambar di folder 'storage/products' dengan path lengkap
            $imagePath = $request->file('image')->store('products', 'public');
            // Tambahkan prefix 'storage/' untuk akses melalui symlink
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        Product::create($validatedData);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan form untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Perbarui data produk di database.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama (jika ada)
            if ($product->image) {
                // Path di disk bisa dengan atau tanpa 'storage/' prefix
                $pathToDelete = str_replace('storage/', '', $product->image);
                Storage::disk('public')->delete($pathToDelete);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
            // Tambahkan prefix 'storage/' untuk akses melalui symlink
            $validatedData['image'] = 'storage/' . $imagePath;
        } else {
            // Jika tidak ada gambar baru, jangan ubah field image
            unset($validatedData['image']);
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk dari database.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar terkait (jika ada)
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}
