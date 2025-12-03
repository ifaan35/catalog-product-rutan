{{-- resources/views/products/search.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        {{-- Header Section --}}
        <div class="mb-8">
            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:underline">Home</a> / 
                <span>Hasil Pencarian</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Hasil Pencarian: "{{ $query }}"
            </h1>
            <p class="text-gray-600 dark:text-gray-400">Menampilkan {{ $products->total() }} produk</p>
        </div>

        {{-- Search Again Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
            <form action="{{ route('products.search') }}" method="GET" class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Cari produk lain..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <span class="bg-pink-600 hover:bg-pink-700 text-white px-3 py-1 rounded text-sm transition">Cari</span>
                    </button>
                </div>
            </form>
            
            {{-- Category Links --}}
            <div class="flex flex-wrap gap-2 mt-6 justify-center">
                <a href="{{ route('products.index') }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300 transition">Semua</a>
                @php
                    $categoryIcons = [
                        'Peternakan' => '🐄',
                        'Perikanan' => '🐟', 
                        'Pertanian' => '🌾'
                    ];
                @endphp
                @if(isset($categories))
                    @foreach($categories as $category)
                        <a href="{{ route('products.category', $category->slug) }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300 transition">
                            {{ $categoryIcons[$category->name] ?? '📦' }} {{ $category->name }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($products as $product)
                {{-- Product Card --}}
                <a href="{{ route('product.show', $product->id) }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500 dark:text-gray-400">{{ $product->name }}</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-pink-600 dark:text-pink-400 mt-1">
                            @if($product->category)
                                {{ $product->category->name }}
                            @else
                                Tidak berkategori
                            @endif
                        </p>
                        <div class="flex items-center mt-2">
                            <span class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                            @if($product->original_price)
                                <span class="text-sm text-gray-400 line-through ml-2">${{ number_format($product->original_price, 2) }}</span>
                            @endif
                        </div>
                        @if($product->is_trending)
                            <span class="inline-block bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full mt-2">🔥 Trending</span>
                        @endif
                    </div>
                </a>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">
                        Tidak ada produk yang cocok dengan pencarian "{{ $query }}".
                    </p>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Saran:</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                            <li>• Periksa ejaan kata kunci</li>
                            <li>• Gunakan kata kunci yang lebih umum</li>
                            <li>• Coba kategori produk yang berbeda</li>
                        </ul>
                    </div>
                    <div class="mt-6 space-x-4">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-lg transition duration-300">
                            Lihat Semua Produk
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition duration-300">
                            Kembali ke Home
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="mt-8">
                {{ $products->appends(['q' => $query])->links() }}
            </div>
        @endif

    </div>
</x-app-layout>