{{-- resources/views/products/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        {{-- Header Section --}}
        <div class="mb-8">
            {{-- Breadcrumb --}}
            <div class="text-sm mb-4" style="color: #072138;">
                <a href="{{ route('home') }}" class="hover:underline" style="color: #F3C32A;">Home</a> / 
                <span>All Products</span>
            </div>

            <h1 class="text-3xl font-bold mb-2" style="color: #072138;">Semua Produk</h1>
            <p class="text-gray-600">Jelajahi koleksi lengkap produk kami</p>
        </div>

        {{-- Filter & Search Section --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-8" style="background-color: #072138;">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                {{-- Search Form --}}
                <form action="{{ route('products.search') }}" method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Cari produk..." 
                               class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:outline-none" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>

                {{-- Category Links --}}
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('products.index') }}" class="px-3 py-1 text-white rounded-full text-sm transition" style="background-color: #F3C32A; color: #072138;">Semua</a>
                    @php
                        $categoryIcons = [
                            'Peternakan' => '🐄',
                            'Perikanan' => '🐟', 
                            'Pertanian' => '🌾'
                        ];
                    @endphp
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <a href="{{ route('products.category', $category->slug) }}" class="px-3 py-1 rounded-full text-sm transition hover:opacity-80" style="background-color: #DFE1E3; color: #072138;">
                                {{ $categoryIcons[$category->name] ?? '📦' }} {{ $category->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($products as $product)
                @php $isSoldOut = $product->stock <= 0; @endphp
                
                {{-- Product Card dengan kondisi sold out --}}
                <{{ $isSoldOut ? 'div' : 'a' }} 
                    @if(!$isSoldOut) href="{{ route('product.show', $product->id) }}" @endif
                    class="block bg-white rounded-lg shadow-md transition duration-300 overflow-hidden
                           {{ $isSoldOut ? 'opacity-50 cursor-not-allowed border-red-500 border-2' : 'hover:shadow-xl' }}">
                    <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500">{{ $product->name }}</span>
                        @endif
                        
                        @if($isSoldOut)
                            <div class="absolute inset-0 bg-red-600 bg-opacity-75 flex items-center justify-center">
                                <span class="text-white text-lg font-black rotate-45 border-4 border-white px-3 py-1">SOLD OUT</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold truncate" style="color: #072138;">{{ $product->name }}</h3>
                        <p class="text-sm mt-1" style="color: #F3C32A;">
                            @if($product->category)
                                {{ $product->category->name }}
                            @else
                                Tidak berkategori
                            @endif
                        </p>
                        <p class="text-sm text-gray-500 mt-1">Stok: 
                            <span class="font-bold text-{{ $isSoldOut ? 'red' : 'green' }}-600">
                                {{ $isSoldOut ? 'HABIS' : $product->stock }}
                            </span>
                        </p>
                        <div class="flex items-center mt-2">
                            <span class="text-xl font-bold" style="color: #072138;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->original_price)
                                <span class="text-sm text-gray-400 line-through ml-2">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        @if($product->is_trending && !$isSoldOut)
                            <span class="inline-block bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full mt-2">🔥 Trending</span>
                        @elseif($isSoldOut)
                            <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full mt-2">STOK HABIS</span>
                        @endif
                    </div>
                </{{ $isSoldOut ? 'div' : 'a' }}>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl mb-4">📦</div>
                    <h3 class="text-xl font-semibold mb-2" style="color: #072138;">Belum Ada Produk</h3>
                    <p class="text-gray-500 mb-4">Produk belum tersedia saat ini.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-white font-medium rounded-lg transition duration-300 hover:opacity-90" style="background-color: #F3C32A; color: #072138;">
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

    </div>
</x-app-layout>