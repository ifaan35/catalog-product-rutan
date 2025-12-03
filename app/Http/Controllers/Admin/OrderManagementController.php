<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index()
    {
        // Ambil semua order terbaru dengan pagination
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Tampilkan order lengkap dengan item di dalamnya
        $order = Order::with(['orderItems', 'user'])->findOrFail($id);
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', "Status Pesanan {$order->order_number} berhasil diperbarui menjadi " . ucfirst($order->status) . ".");
    }
}
