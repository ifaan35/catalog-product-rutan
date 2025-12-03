{{-- resources/views/admin/dashboard.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold" style="color: #072138;">
                <svg class="w-8 h-8 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Dashboard Petugas RUTAN
            </h1>
            <div class="text-sm text-gray-500">
                <span style="color: #F3C32A;" class="font-bold">RUTAN SHOP</span> Admin Panel
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow-lg rounded-lg p-6" style="border-left: 4px solid #F3C32A;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pesanan Menunggu</p>
                        <p class="text-3xl font-bold" style="color: #F3C32A;">{{ $pendingOrders }}</p>
                    </div>
                    <div class="p-3 rounded-full" style="background-color: #FFF7E6;">
                        <svg class="w-6 h-6" style="color: #F3C32A;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6" style="border-left: 4px solid #10B981;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6" style="border-left: 4px solid #3B82F6;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Produk</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalProducts }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6" style="border-left: 4px solid #8B5CF6;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Orders Hari Ini</p>
                        <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</p>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <div class="p-3 rounded-full inline-flex mb-4" style="background-color: #F3C32A;">
                    <svg class="w-8 h-8" style="color: #072138;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2" style="color: #072138;">Kelola Produk</h3>
                <p class="text-gray-600 mb-4">Tambah, edit, atau hapus produk RUTAN SHOP</p>
                <a href="{{ route('admin.products.index') }}" class="inline-block px-4 py-2 rounded-lg font-medium transition duration-300" style="background-color: #072138; color: white;">
                    Manajemen Produk
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <div class="p-3 bg-green-100 rounded-full inline-flex mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Kelola Pesanan</h3>
                <p class="text-gray-600 mb-4">Lihat dan update status pesanan customer</p>
                <a href="{{ route('admin.orders.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition duration-300">
                    Lihat Pesanan
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <div class="p-3 bg-blue-100 rounded-full inline-flex mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Laporan</h3>
                <p class="text-gray-600 mb-4">Lihat statistik penjualan dan performa</p>
                <button class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-300">
                    Segera Hadir
                </button>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold" style="color: #072138;">5 Pesanan Terbaru</h2>
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition duration-300 hover:shadow-md" style="background-color: #F3C32A; color: #072138;">
                        Lihat Semua Pesanan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                @include('admin.orders.latest_list', ['orders' => $latestOrders])
            </div>
        </div>
    </div>
</x-app-layout>