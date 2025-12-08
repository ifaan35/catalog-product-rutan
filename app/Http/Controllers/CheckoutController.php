<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Ambil data keranjang
        $cartItems = session()->get('cart', []);
        
        // Jika keranjang kosong, tendang balik ke halaman produk
        if (empty($cartItems)) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total belanja
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Tampilkan view checkout
        return view('checkout.index', compact('cartItems', 'total'));
    }
    
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        $cart = session()->get('cart');
        
        if(!$cart) {
            return redirect()->route('home')->with('error', 'Keranjang kosong.');
        }

        // Hitung total ulang di backend untuk keamanan (jangan percaya input hidden total dari form 100%)
        $totalAmount = 0;
        foreach($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // 2. Mulai Database Transaction
        // Kita gunakan try-catch block untuk memastikan semua data tersimpan atau tidak sama sekali
        try {
            DB::beginTransaction();

            // A. Simpan Data Order Utama
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Contoh: ORD-65A1B2C
                'recipient_name' => $request->recipient_name,
                'phone_number' => $request->phone_number,
                'address' => $request->address . ', ' . $request->city . ', ' . $request->postal_code,
                'total_amount' => $totalAmount,
                'status' => 'pending', // Status awal
                'payment_status' => 'unpaid',
                'notes' => $request->notes,
            ]);

            // B. Simpan Item Order & Kurangi Stok
            foreach($cart as $cartKey => $item) {
                // Simpan ke tabel order_items
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'], // Simpan nama saat beli (jaga-jaga nama produk berubah nanti)
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'size' => $item['size'] ?? 'Default',
                ]);

                // Kurangi Stok Produk
                $product = Product::find($item['id']);
                if($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            // C. Hapus Keranjang dari Session
            session()->forget('cart');

            DB::commit(); // Simpan perubahan permanen

            // Redirect ke halaman sukses (atau halaman riwayat pesanan)
            return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat! Nomor Order: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('checkout.history', compact('orders'));
    }
}
