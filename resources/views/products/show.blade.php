{{-- resources/views/products/show.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        {{-- Breadcrumb Sederhana --}}
        <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            <a href="{{ route('home') }}" class="hover:underline">Home</a> / 
            <span>{{ $product->name }}</span>
        </div>

        @php $isSoldOut = $product->stock <= 0; @endphp

        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- KOLOM KIRI: GALERI GAMBAR --}}
            <div class="relative">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg mb-4 object-cover h-96">
                @else
                    <div class="w-full h-96 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-gray-500 dark:text-gray-400">{{ $product->name }}</span>
                    </div>
                @endif
                
                @if($isSoldOut)
                    <div class="absolute inset-0 bg-red-600 bg-opacity-75 flex items-center justify-center rounded-lg">
                        <span class="text-white text-3xl font-black rotate-45 border-4 border-white px-6 py-2">STOK HABIS</span>
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: DETAIL PRODUK & BELI --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h1>
                <div class="flex items-center mb-4">
                    <p class="text-2xl font-extrabold text-pink-600 dark:text-pink-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if($product->original_price)
                        <p class="text-lg line-through ml-3 text-gray-500 dark:text-gray-400">Rp {{ number_format($product->original_price, 0, ',', '.') }}</p>
                    @endif
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-2">{{ $product->description }}</p>
                <p class="text-sm text-pink-600 dark:text-pink-400 mb-6">Kategori: 
                    @if($product->category)
                        {{ $product->category->name }}
                    @else
                        Tidak berkategori
                    @endif
                </p>

                {{-- FORM ADD TO CART --}}
                <form action="{{ route('cart.store', $product->id) }}" method="POST"> 
                    @csrf
                    
                    @if(!$isSoldOut)
                        {{-- Size Selector --}}
                        <div class="mb-4">
                            <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Ukuran:</label>
                            <select id="size" name="size" class="border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-900 dark:text-gray-300">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L (Stok: {{ $product->stock }})</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="flex items-center space-x-2">
                                <label for="quantity" class="text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 w-20 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-900 dark:text-gray-300">
                            </div>
                            
                            {{-- Tombol Add to Cart --}}
                            <button type="submit" class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-semibold transition duration-300 shadow-md">
                                🛒 Tambah ke Keranjang
                            </button>
                        </div>
                    @else
                        {{-- Notifikasi Sold Out --}}
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-2xl font-bold text-red-600 text-center">Produk ini sedang habis.</p>
                            <p class="text-center text-red-500 mt-2">Silakan cek kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
                        </div>
                    @endif
                    
                    <p class="text-sm text-gray-500 dark:text-gray-400">Stok Tersisa: 
                        <span class="font-bold text-{{ $isSoldOut ? 'red' : 'green' }}-600">
                            {{ $isSoldOut ? '0 (HABIS)' : $product->stock }}
                        </span>
                    </p>
                </form>

            </div>
        </div>

        {{-- BAGIAN PRODUK SERUPA (Related Products) --}}
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Produk Serupa</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($relatedProducts as $related)
                    @php $relatedSoldOut = $related->stock <= 0; @endphp
                    
                    {{-- Menggunakan card style yang sama dengan Home Page dengan kondisi sold out --}}
                    <{{ $relatedSoldOut ? 'div' : 'a' }} 
                        @if(!$relatedSoldOut) href="{{ route('product.show', $related->id) }}" @endif
                        class="block bg-white dark:bg-gray-800 rounded-lg shadow-md transition duration-300 overflow-hidden
                               {{ $relatedSoldOut ? 'opacity-50 cursor-not-allowed border-red-500 border-2' : 'hover:shadow-xl' }}">
                         <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden relative">
                            @if($related->image)
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-500 dark:text-gray-400">{{ $related->name }}</span>
                            @endif
                            
                            @if($relatedSoldOut)
                                <div class="absolute inset-0 bg-red-600 bg-opacity-75 flex items-center justify-center">
                                    <span class="text-white text-lg font-black rotate-45 border-4 border-white px-3 py-1">SOLD OUT</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $related->name }}</h3>
                            <p class="text-sm text-pink-600 dark:text-pink-400 mt-1">
                                @if($related->category)
                                    {{ $related->category->name }}
                                @else
                                    Tidak berkategori
                                @endif
                            </p>
                            <p class="text-sm text-gray-500 mt-1">Stok: 
                                <span class="font-bold text-{{ $relatedSoldOut ? 'red' : 'green' }}-600">
                                    {{ $relatedSoldOut ? 'HABIS' : $related->stock }}
                                </span>
                            </p>
                            <div class="flex items-center mt-2">
                                <span class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                @if($related->original_price)
                                    <span class="text-sm text-gray-400 line-through ml-2">Rp {{ number_format($related->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                    </{{ $relatedSoldOut ? 'div' : 'a' }}>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">Belum ada produk serupa tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>
</x-app-layout>