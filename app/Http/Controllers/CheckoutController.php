<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    // Dummy shipping rates (replace with real API integration later)
    protected $shippingRates = [
        'JNE' => 25000,
        'JNT' => 23000,
        'POS' => 18000,
        'AMBIL SENDIRI' => 0,
    ];

    public function index()
    {
        // Ambil data keranjang
        $cartItems = session()->get('cart', []);
        
        // Jika keranjang kosong, tendang balik ke halaman produk
        if (empty($cartItems)) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung subtotal belanja
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        // Pass subtotal and shipping rates to view
        // Let frontend calculate total dynamically
        return view('checkout.index', compact('cartItems', 'subtotal'))->with('shippingRates', $this->shippingRates);
    }
    
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'province_id' => 'required|string',
            'regency_id' => 'required|string',
            'district_id' => 'required|string',
            'village_id' => 'required|string',
            'postal_code' => 'required|string',
            'shipping_method' => 'required|string',
            'shipping_cost' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $cart = session()->get('cart');
        
        if(!$cart) {
            return redirect()->route('home')->with('error', 'Keranjang kosong.');
        }

        // Hitung total ulang di backend untuk keamanan
        $subtotalAmount = 0;
        foreach($cart as $item) {
            $subtotalAmount += $item['price'] * $item['quantity'];
        }

        // Validasi shipping cost dengan rate yang tersedia
        $expectedShippingCost = $this->shippingRates[$request->shipping_method] ?? 0;
        if ($request->shipping_cost != $expectedShippingCost) {
            return redirect()->back()->with('error', 'Biaya pengiriman tidak valid.');
        }

        // Total yang benar = subtotal + shipping cost
        $totalAmount = $subtotalAmount + $request->shipping_cost;

        // 2. Mulai Database Transaction
        // Kita gunakan try-catch block untuk memastikan semua data tersimpan atau tidak sama sekali
        try {
            DB::beginTransaction();

            // A. Simpan Data Order Utama
            // Get area names from Indonesia API
            $areaNames = $this->getAreaNames($request);
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Contoh: ORD-65A1B2C
                'recipient_name' => $request->customer_name,
                'phone_number' => $request->customer_phone,
                'address' => $request->address . ', ' . $areaNames['village'] . ', ' . $areaNames['district'] . ', ' . $areaNames['regency'] . ', ' . $areaNames['province'] . ' ' . $request->postal_code,
                'shipping_method' => $request->shipping_method,
                'shipping_cost' => $request->shipping_cost,
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

    /**
     * Helper method to get area names from Indonesia API
     */
    private function getAreaNames($request)
    {
        $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';
        $areaNames = [
            'province' => 'Unknown Province',
            'regency' => 'Unknown Regency',
            'district' => 'Unknown District',
            'village' => 'Unknown Village'
        ];

        try {
            // Get province name
            if ($request->province_id) {
                $response = \Illuminate\Support\Facades\Http::get($baseUrl . '/province/' . $request->province_id . '.json');
                if ($response->successful()) {
                    $areaNames['province'] = $response->json()['name'] ?? 'Unknown Province';
                }
            }

            // Get regency name
            if ($request->regency_id) {
                $response = \Illuminate\Support\Facades\Http::get($baseUrl . '/regency/' . $request->regency_id . '.json');
                if ($response->successful()) {
                    $areaNames['regency'] = $response->json()['name'] ?? 'Unknown Regency';
                }
            }

            // Get district name
            if ($request->district_id) {
                $response = \Illuminate\Support\Facades\Http::get($baseUrl . '/district/' . $request->district_id . '.json');
                if ($response->successful()) {
                    $areaNames['district'] = $response->json()['name'] ?? 'Unknown District';
                }
            }

            // Get village name
            if ($request->village_id) {
                $response = \Illuminate\Support\Facades\Http::get($baseUrl . '/village/' . $request->village_id . '.json');
                if ($response->successful()) {
                    $areaNames['village'] = $response->json()['name'] ?? 'Unknown Village';
                }
            }
        } catch (\Exception $e) {
            Log::error('Error fetching area names: ' . $e->getMessage());
        }

        return $areaNames;
    }
}
