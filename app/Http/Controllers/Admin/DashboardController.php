<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik penting
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalSales = Order::where('status', 'delivered')->sum('total_amount');
        $latestOrders = Order::with(['user', 'orderItems'])->orderBy('created_at', 'desc')->limit(5)->get();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('pendingOrders', 'totalSales', 'latestOrders', 'totalProducts'));
    }
}
