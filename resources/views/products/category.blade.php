{{-- resources/views/products/category.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        {{-- Header Section --}}
        <div class="mb-8">
            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:underline">Home</a> / 
                <span>{{ $category }}</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $category }}</h1>
            <p class="text-gray-600 dark:text-gray-400">Temukan produk {{ $category }} terbaik pilihan kami</p>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($products as $product)
                {{-- Product Card --}}
                <a href="{{ route('product.show', $product->id) }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
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
                    <div class="text-6xl mb-4">📦</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">Produk kategori {{ $category }} belum tersedia saat ini.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-lg transition duration-300">
                        Kembali ke Home
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif

        {{-- Back to Categories --}}
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}#categories" class="inline-flex items-center text-pink-600 hover:text-pink-800 dark:text-pink-400 dark:hover:text-pink-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                </svg>
                Lihat Kategori Lainnya
            </a>
        </div>

    </div>
</x-app-layout>