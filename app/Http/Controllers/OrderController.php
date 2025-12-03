<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan daftar semua pesanan milik user yang sedang login
    public function index()
    {
        // Ambil data order milik user, urutkan dari yang terbaru
        $orders = Order::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('orders.index', compact('orders'));
    }

    // Menampilkan detail satu pesanan
    public function show($id)
    {
        // Ambil order beserta item di dalamnya (Eager Loading)
        $order = Order::with('orderItems')->findOrFail($id);

        // KEAMANAN: Cek apakah order ini benar milik user yang login?
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('orders.show', compact('order'));
    }
}
