<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        try {
            $validated = $request->validate([
                'recipient_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'province_id' => 'required|string',
                'province_name' => 'required|string',
                'regency_id' => 'required|string',
                'regency_name' => 'required|string',
                'district_id' => 'required|string',
                'district_name' => 'required|string',
                'village_id' => 'required|string',
                'village_name' => 'required|string',
                'detail_address' => 'required|string',
                'postal_code' => 'required|string|max:10',
                'notes' => 'nullable|string', // Notes bersifat optional
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Checkout validation failed:', [
                'errors' => $e->errors(),
                'request_data' => $request->except(['password']),
            ]);
            throw $e;
        }

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

            // A. Simpan Data Order Utama dengan Hierarchical Address
            // Format address sebagai kombinasi hierarchical untuk backward compatibility
            $address = "{$request->detail_address}, {$request->village_name}, {$request->district_name}, {$request->regency_name}, {$request->province_name} {$request->postal_code}";
            
            $orderData = [
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Contoh: ORD-65A1B2C
                'recipient_name' => $request->recipient_name,
                'phone_number' => $request->phone_number,
                'address' => $address, // Field lama untuk backward compatibility
                'province_id' => $request->province_id,
                'province_name' => $request->province_name,
                'regency_id' => $request->regency_id,
                'regency_name' => $request->regency_name,
                'district_id' => $request->district_id,
                'district_name' => $request->district_name,
                'village_id' => $request->village_id,
                'village_name' => $request->village_name,
                'detail_address' => $request->detail_address,
                'postal_code' => $request->postal_code,
                'total_amount' => $totalAmount,
                'status' => 'pending', // Status awal
                'payment_status' => 'unpaid',
            ];
            
            // Tambahkan notes hanya jika ada
            if ($request->filled('notes')) {
                $orderData['notes'] = $request->notes;
            }
            
            Log::info('Creating order with data:', $orderData);
            
            $order = Order::create($orderData);
            
            Log::info('Order created successfully:', ['order_id' => $order->id, 'order_number' => $order->order_number]);

            // B. Simpan Item Order & Kurangi Stok
            foreach($cart as $cartKey => $item) {
                // Simpan ke tabel order_items
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'], // Simpan nama saat beli (jaga-jaga nama produk berubah nanti)
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Kurangi Stok Produk
                $product = Product::find($item['id']);
                if($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            // C. Hapus Keranjang dari Session
            session()->forget('cart');
            session()->forget('cart_count');

            DB::commit(); // Simpan perubahan permanen

            Log::info('Order created successfully with QRIS payment:', ['order_id' => $order->id]);

            // Return JSON response untuk AJAX dengan redirect ke halaman QRIS
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'redirect_url' => route('checkout.qris', $order->id)
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            Log::error('Checkout process failed:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Return JSON for AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show success page with order details
     */
    public function success(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Anda tidak berhak mengakses pesanan ini.');
        }

        $order->load('orderItems');
        return view('checkout.success', compact('order'));
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
     * Show QRIS payment page
     */
    public function qris(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Anda tidak berhak mengakses pesanan ini.');
        }

        $order->load('orderItems');
        return view('checkout.qris', compact('order'));
    }

    /**
     * Upload payment proof
     */
    public function uploadPaymentProof(Request $request, Order $order)
    {
        // Pastikan user hanya bisa upload untuk order miliknya
        if ($order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak berhak mengakses pesanan ini.'
            ], 403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Hapus bukti pembayaran lama jika ada
            if ($order->payment_proof) {
                Storage::delete('public/' . $order->payment_proof);
            }

            // Upload bukti pembayaran baru
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            // Update order
            $order->payment_proof = $path;
            // Status tetap 'unpaid' sampai admin verifikasi dan ubah ke 'paid'
            $order->status = 'pending'; // Menunggu verifikasi admin
            $order->save();

            Log::info('Payment proof uploaded:', [
                'order_id' => $order->id,
                'payment_proof' => $path
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bukti pembayaran berhasil diunggah. Pesanan Anda sedang diproses.',
                'redirect_url' => route('checkout.success', $order->id)
            ]);

        } catch (\Exception $e) {
            Log::error('Payment proof upload failed:', [
                'order_id' => $order->id,
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle Midtrans notification callback (DEPRECATED - tidak digunakan lagi)
     * Method ini dipertahankan untuk backward compatibility
     */
    public function handleMidtransNotification(Request $request)
    {
        // Method ini tidak digunakan lagi karena sudah beralih ke QRIS
        // Dipertahankan untuk backward compatibility
        return response()->json([
            'status' => 'error', 
            'message' => 'Midtrans payment method is no longer supported'
        ], 410);
        
        /* Original Midtrans code - commented out
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $notification = new \Midtrans\Notification();

            $transactionStatus = $notification->transaction_status;
            $orderNumber = $notification->order_id;
            $fraudStatus = $notification->fraud_status;

            Log::info('Midtrans notification received:', [
                'order_number' => $orderNumber,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
            ]);

            // Cari order berdasarkan order_number
            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                Log::error('Order not found for notification:', ['order_number' => $orderNumber]);
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }

            // Update status pembayaran berdasarkan notifikasi Midtrans
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->payment_status = 'paid';
                    $order->status = 'processing';
                }
            } else if ($transactionStatus == 'settlement') {
                $order->payment_status = 'paid';
                $order->status = 'processing';
            } else if ($transactionStatus == 'pending') {
                $order->payment_status = 'pending';
                $order->status = 'pending';
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->payment_status = 'failed';
                $order->status = 'cancelled';
                
                // Kembalikan stok produk jika pembayaran gagal
                foreach ($order->orderItems as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);
                    }
                }
            }

            $order->save();

            Log::info('Order updated from Midtrans notification:', [
                'order_id' => $order->id,
                'payment_status' => $order->payment_status,
                'status' => $order->status,
            ]);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Midtrans notification handling failed:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
        */
    }
}
