{{-- Trending Products Section --}}
<div class="text-center mb-8 sm:mb-12">
    <h2 class="text-2xl sm:text-3xl font-bold mb-3" style="color: #072138;">🔥 Produk Trending</h2>
    <p class="text-sm sm:text-base px-4" style="color: #072138; opacity: 0.7;">Produk terlaris dan paling disukai pelanggan kami</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    @forelse ($trendingProducts as $product)
        {{-- Tentukan apakah produk Sold Out --}}
        @php $isSoldOut = $product->stock <= 0; @endphp

        {{-- Gunakan div (tidak bisa diklik) jika habis, atau a (bisa diklik) jika tersedia --}}
        <{{ $isSoldOut ? 'div' : 'a' }} 
            @if(!$isSoldOut) href="{{ route('product.show', $product->id) }}" @endif
            class="block bg-white rounded-lg shadow-md transition duration-300 overflow-hidden border-2 border-transparent 
                   {{ $isSoldOut ? 'opacity-50 cursor-not-allowed border-red-500' : 'hover:shadow-xl hover:border-opacity-30' }}"
            @if(!$isSoldOut) hover:border-pink-300 dark:hover:border-pink-600 @endif>
            
            {{-- Area Gambar --}}
            <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center relative overflow-hidden">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover {{ !$isSoldOut ? 'transition duration-500 hover:scale-105' : '' }}">
                @else
                    <span class="text-gray-500 dark:text-gray-400">{{ $product->name }}</span>
                @endif
                
                @if($isSoldOut)
                    {{-- Tanda Sold Out --}}
                    <div class="absolute inset-0 bg-red-600 bg-opacity-75 flex items-center justify-center">
                        <span class="text-white text-xl font-black rotate-45 border-4 border-white px-4 py-1">SOLD OUT</span>
                    </div>
                @endif
            </div>

            {{-- Area Detail --}}
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $product->name }}</h3>
                <p class="text-sm text-pink-600 dark:text-pink-400 mt-1">
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
                <div class="flex items-center justify-between mt-2">
                    <div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @if($product->original_price)
                            <span class="text-sm line-through ml-2 text-gray-500 dark:text-gray-400">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                </div>
                
                @if(!$isSoldOut)
                    <!-- Quick Add to Cart Button - hanya muncul jika stok ada -->
                    <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-3" onclick="event.stopPropagation();">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full py-2 px-3 bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold rounded-lg transition duration-300">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <!-- Notifikasi Sold Out -->
                    <div class="mt-3 text-center">
                        <span class="text-red-600 font-bold text-sm">STOK HABIS</span>
                    </div>
                @endif
            </div>
        </{{ $isSoldOut ? 'div' : 'a' }}>
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-gray-500 dark:text-gray-400">Belum ada produk trending tersedia.</p>
        </div>
    @endforelse
</div>

{{-- View All Products Link --}}
<div class="text-center mt-8 sm:mt-12">
    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 sm:px-8 sm:py-4 bg-pink-600 hover:bg-pink-700 text-white text-sm sm:text-base font-medium rounded-full transition duration-300 transform hover:scale-105 shadow-lg">
        Lihat Semua Produk
        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </a>
</div>