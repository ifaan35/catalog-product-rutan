{{-- resources/views/admin/dashboard.blade.php --}}

<x-app-layout>
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(243, 195, 42, 0.3); }
            50% { box-shadow: 0 0 30px rgba(243, 195, 42, 0.5); }
        }

        .stat-card {
            animation: slideIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        .action-card {
            animation: slideIn 0.6s ease-out forwards;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .action-card:nth-child(1) { animation-delay: 0.5s; }
        .action-card:nth-child(2) { animation-delay: 0.6s; }
        .action-card:nth-child(3) { animation-delay: 0.7s; }

        .icon-wrapper {
            animation: float 3s ease-in-out infinite;
        }

        .header-gradient {
            background: linear-gradient(135deg, #07213C 0%, #0d2949 50%, #1a3a5c 100%);
            border-radius: 16px;
            padding: 32px;
            color: white;
            margin-bottom: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            line-height: 1;
        }

        .recent-orders-container {
            animation: slideIn 0.8s ease-out 0.8s both;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="header-gradient mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">
                        👋 Selamat Datang, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-blue-100 text-lg">Dashboard RUTAN SHOP Admin - Kelola toko Anda dengan mudah</p>
                </div>
                <div class="text-right hidden md:block">
                    <p class="text-blue-100 text-sm mb-1">Admin Panel</p>
                    <p class="text-3xl font-bold" style="color: #ECBF62;">RUTAN</p>
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card 1: Pesanan Menunggu -->
            <div class="stat-card bg-white rounded-2xl p-8 shadow-xl border-t-4" style="border-color: #ECBF62;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">⏳ Pesanan Menunggu</p>
                        <p class="stat-number" style="color: #ECBF62;">{{ $pendingOrders }}</p>
                        <p class="text-gray-500 text-xs mt-2">Perlu diproses</p>
                    </div>
                    <div class="icon-wrapper p-4 rounded-full" style="background: linear-gradient(135deg, #FFF7E6 0%, #FFE8B6 100%);">
                        <svg class="w-8 h-8" style="color: #ECBF62;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Penjualan -->
            <div class="stat-card bg-white rounded-2xl p-8 shadow-xl border-t-4" style="border-color: #10B981;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">💰 Total Penjualan</p>
                        <p class="stat-number" style="color: #10B981;">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-xs mt-2">Dari pesanan terselesaikan</p>
                    </div>
                    <div class="icon-wrapper p-4 rounded-full" style="background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);">
                        <svg class="w-8 h-8" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Produk -->
            <div class="stat-card bg-white rounded-2xl p-8 shadow-xl border-t-4" style="border-color: #07213C;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">📦 Total Produk</p>
                        <p class="stat-number" style="color: #07213C;">{{ $totalProducts }}</p>
                        <p class="text-gray-500 text-xs mt-2">Produk aktif</p>
                    </div>
                    <div class="icon-wrapper p-4 rounded-full" style="background: linear-gradient(135deg, #E0E7FF 0%, #C7D2FE 100%);">
                        <svg class="w-8 h-8" style="color: #07213C;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 4: Orders Hari Ini -->
            <div class="stat-card bg-white rounded-2xl p-8 shadow-xl border-t-4" style="border-color: #D3D4D7;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">📋 Orders Hari Ini</p>
                        <p class="stat-number" style="color: #07213C;">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</p>
                        <p class="text-gray-500 text-xs mt-2">Pesanan baru hari ini</p>
                    </div>
                    <div class="icon-wrapper p-4 rounded-full" style="background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);">
                        <svg class="w-8 h-8" style="color: #07213C;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Card 1: Manajemen Produk -->
            <div class="action-card bg-white rounded-2xl p-8 text-center border-l-4" style="border-left-color: #ECBF62; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: linear-gradient(135deg, #ECBF6210 0%, #ECBF6220 100%); border-radius: 50%;"></div>
                <div class="relative z-10">
                    <div class="p-4 rounded-full inline-flex mb-4" style="background: linear-gradient(135deg, #ECBF62, #D4A634);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2" style="color: #072138;">📦 Kelola Produk</h3>
                    <p class="text-gray-600 mb-4 text-sm">Tambah, edit, atau hapus produk RUTAN SHOP dengan mudah</p>
                    <a href="{{ route('admin.products.index') }}" class="inline-block px-6 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105" style="background-color: #ECBF62; color: #072138;">
                        Manajemen Produk →
                    </a>
                </div>
            </div>

            <!-- Card 2: Kelola Pesanan -->
            <div class="action-card bg-white rounded-2xl p-8 text-center border-l-4" style="border-left-color: #10B981; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: linear-gradient(135deg, #10B98110 0%, #10B98120 100%); border-radius: 50%;"></div>
                <div class="relative z-10">
                    <div class="p-4 rounded-full inline-flex mb-4" style="background: linear-gradient(135deg, #10B981, #059669);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">📋 Kelola Pesanan</h3>
                    <p class="text-gray-600 mb-4 text-sm">Lihat dan update status pesanan customer secara real-time</p>
                    <a href="{{ route('admin.orders.index') }}" class="inline-block px-6 py-3 rounded-lg font-semibold text-white transition duration-300 transform hover:scale-105" style="background: linear-gradient(135deg, #10B981, #059669);">
                        Lihat Pesanan →
                    </a>
                </div>
            </div>

            <!-- Card 3: Laporan -->
            <div class="action-card bg-white rounded-2xl p-8 text-center border-l-4" style="border-left-color: #07213C; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: linear-gradient(135deg, #07213C10 0%, #07213C20 100%); border-radius: 50%;"></div>
                <div class="relative z-10">
                    <div class="p-4 rounded-full inline-flex mb-4" style="background: linear-gradient(135deg, #07213C, #0a1929);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">📊 Laporan & Analitik</h3>
                    <p class="text-gray-600 mb-4 text-sm">Lihat statistik penjualan dan performa toko Anda</p>
                    <button class="inline-block px-6 py-3 rounded-lg font-semibold text-white transition duration-300 transform hover:scale-105 cursor-not-allowed opacity-75" style="background: linear-gradient(135deg, #07213C, #0a1929);">
                        ⏱️ Segera Hadir
                    </button>
                </div>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="recent-orders-container bg-white shadow-xl rounded-2xl overflow-hidden border-t-4" style="border-color: #ECBF62;">
            <div class="px-8 py-6 border-b border-gray-200" style="background: linear-gradient(135deg, rgba(236, 191, 98, 0.05) 0%, rgba(236, 191, 98, 0.03) 100%);">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold" style="color: #072138;">📦 5 Pesanan Terbaru</h2>
                        <p class="text-gray-500 text-sm mt-1">Pesanan terbaru dari customer</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-6 py-3 text-sm font-semibold rounded-lg transition duration-300 transform hover:scale-105" style="background-color: #ECBF62; color: #072138;">
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