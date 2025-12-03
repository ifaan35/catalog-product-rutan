<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import Model Product
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Method untuk menampilkan isi keranjang
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    // Method untuk menambahkan produk ke keranjang
    public function store(Request $request, Product $product)
    {
        // 1. Ambil data keranjang saat ini dari session. Jika kosong, buat array kosong.
        $cart = session()->get('cart', []);
        
        // Ambil input kuantitas dan ukuran dari form
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size', 'Default');
        
        // Kunci unik keranjang: ID produk + Ukuran
        $cartKey = $product->id . '-' . $size;

        // 2. Cek apakah produk dengan variasi ini sudah ada di keranjang
        if(isset($cart[$cartKey])) {
            // Jika sudah ada, tambahkan kuantitasnya
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            // Jika belum ada, tambahkan item baru
            $cart[$cartKey] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "size" => $size,
                "image" => $product->image_url,
            ];
        }
        
        // 3. Simpan array keranjang yang baru ke dalam session
        session()->put('cart', $cart);
        
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Method untuk menghapus item dari keranjang
    public function destroy(Request $request)
    {
        // Kunci keranjang dikirim melalui request (cart_key: product_id-size)
        $cartKey = $request->input('cart_key');

        if ($cartKey) {
            $cart = session()->get('cart');

            // Hapus item menggunakan kunci unik
            if (isset($cart[$cartKey])) {
                unset($cart[$cartKey]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
            }
        }
        return redirect()->back()->with('error', 'Item tidak ditemukan.');
    }

    // Method untuk memperbarui kuantitas item
    public function update(Request $request)
    {
        $cartKey = $request->input('cart_key');
        $newQuantity = $request->input('quantity');

        if ($cartKey && $newQuantity) {
            $cart = session()->get('cart');

            if (isset($cart[$cartKey])) {
                // Pastikan kuantitas tidak nol atau negatif
                if ($newQuantity > 0) {
                    $cart[$cartKey]['quantity'] = $newQuantity;
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Kuantitas berhasil diperbarui.');
                } else {
                    // Jika kuantitas 0, kita bisa menghapusnya
                    unset($cart[$cartKey]);
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Item dihapus karena kuantitas 0.');
                }
            }
        }
        return redirect()->back()->with('error', 'Gagal memperbarui kuantitas.');
    }
}
