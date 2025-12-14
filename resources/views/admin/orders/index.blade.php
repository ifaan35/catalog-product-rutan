{{-- resources/views/admin/orders/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold" style="color: #072138;">
                <svg class="w-8 h-8 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Manajemen Pesanan RUTARO SHOP
            </h1>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Filter Status -->
        <div class="bg-white shadow-lg rounded-lg mb-6 p-4">
            <div class="flex flex-wrap gap-2">
                <span class="text-sm font-medium text-gray-700">Filter Status:</span>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ !request('status') ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }} transition duration-200">
                    Semua
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }} transition duration-200">
                    Menunggu
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'processing' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }} transition duration-200">
                    Diproses
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'shipped' ? 'bg-purple-500 text-white' : 'bg-purple-100 text-purple-800 hover:bg-purple-200' }} transition duration-200">
                    Dikirim
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'delivered' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }} transition duration-200">
                    Selesai
                </a>
            </div>
        </div>

        <!-- Tabel Pesanan -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium" style="color: #072138;">
                    Daftar Pesanan ({{ $orders->total() }} total)
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                @include('admin.orders.latest_list', ['orders' => $orders])
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>