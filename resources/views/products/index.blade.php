{{-- resources/views/products/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" style="background-color: #F5F6F8;">

        {{-- Header Section --}}
        <div class="mb-8">
            {{-- Breadcrumb --}}
            <div class="mb-4" style="color: #6B7280;">
                <a href="{{ route('home') }}" class="hover:underline" style="color: #07213C;">Home</a> / 
                <span>All Products</span>
            </div>

            <h1 class="text-3xl font-bold mb-2" style="color: #07213C;">Semua Produk</h1>
            <p style="color: #6B7280;">Jelajahi koleksi lengkap produk kami</p>
        </div>

        {{-- Filter & Search Section --}}
        <div class="card rounded-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                {{-- Search Form --}}
                <form action="{{ route('products.search') }}" method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Cari produk..." 
                               class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:border-0" style="border-color: #E1E2E4; focus-ring-color: #ECBF62;">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #9CA3AF;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>

                {{-- Category Links --}}
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('products.index') }}" class="px-3 py-1 text-white rounded-full text-sm transition" style="background-color: #ECBF62; color: #07213C;">Semua</a>
                    @php
                        $categoryIcons = [
                            'Peternakan' => '🐄',
                            'Perikanan' => '🐟', 
                            'Pertanian' => '🌾'
                        ];
                    @endphp
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <a href="{{ route('products.category', $category->slug) }}" class="px-3 py-1 rounded-full text-sm transition" style="background-color: #E1E2E4; color: #07213C;">
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
                    class="block card rounded-lg transition duration-300 overflow-hidden
                           {{ $isSoldOut ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-xl' }}">
                    <div class="h-48 flex items-center justify-center overflow-hidden relative" style="background-color: #E1E2E4;">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span style="color: #6B7280;">{{ $product->name }}</span>
                        @endif
                        
                        @if($isSoldOut)
                            <div class="absolute inset-0 bg-opacity-75 flex items-center justify-center" style="background-color: rgba(239, 68, 68, 0.75);">
                                <span class="text-white text-lg font-black rotate-45 border-4 border-white px-3 py-1">SOLD OUT</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold truncate" style="color: #07213C;">{{ $product->name }}</h3>
                        <p class="text-sm mt-1" style="color: #ECBF62;">
                            @if($product->category)
                                {{ $product->category->name }}
                            @else
                                Tidak berkategori
                            @endif
                        </p>
                        <p class="text-sm mt-1" style="color: #6B7280;">Stok: 
                            <span class="font-bold" style="color: {{ $isSoldOut ? '#EF4444' : '#10B981' }};">
                                {{ $isSoldOut ? 'HABIS' : $product->stock }}
                            </span>
                        </p>
                        <div class="flex items-center mt-2">
                            <span class="text-xl font-bold" style="color: #07213C;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->original_price)
                                <span class="text-sm line-through ml-2" style="color: #9CA3AF;">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        @if($product->is_trending && !$isSoldOut)
                            <span class="inline-block text-xs px-2 py-1 rounded-full mt-2" style="background-color: rgba(236, 191, 98, 0.2); color: #ECBF62;">🔥 Trending</span>
                        @elseif($isSoldOut)
                            <span class="inline-block text-xs px-2 py-1 rounded-full mt-2" style="background-color: rgba(239, 68, 68, 0.1); color: #EF4444;">STOK HABIS</span>
                        @endif
                    </div>
                </{{ $isSoldOut ? 'div' : 'a' }}>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl mb-4">📦</div>
                    <h3 class="text-xl font-semibold mb-2" style="color: #07213C;">Belum Ada Produk</h3>
                    <p class="mb-4" style="color: #6B7280;">Produk belum tersedia saat ini.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-white font-medium rounded-lg transition duration-300" style="background-color: #ECBF62; color: #07213C;">
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