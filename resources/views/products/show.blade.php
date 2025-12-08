{{-- resources/views/products/show.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" style="background-color: #F5F6F8;">

        {{-- Breadcrumb Sederhana --}}
        <div class="mb-4" style="color: #6B7280;">
            <a href="{{ route('home') }}" class="hover:underline" style="color: #07213C;">Home</a> / 
            <span>{{ $product->name }}</span>
        </div>

        @php $isSoldOut = $product->stock <= 0; @endphp

        <div class="card shadow overflow-hidden sm:rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- KOLOM KIRI: GALERI GAMBAR --}}
            <div class="relative">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg mb-4 object-cover h-96">
                @elseif($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg mb-4 object-cover h-96">
                @else
                    <div class="w-full h-96 rounded-lg flex items-center justify-center mb-4" style="background-color: #E1E2E4;">
                        <span style="color: #6B7280;">{{ $product->name }}</span>
                    </div>
                @endif
                
                @if($isSoldOut)
                    <div class="absolute inset-0 bg-opacity-75 flex items-center justify-center rounded-lg" style="background-color: rgba(239, 68, 68, 0.75);">
                        <span class="text-white text-3xl font-black rotate-45 border-4 border-white px-6 py-2">STOK HABIS</span>
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: DETAIL PRODUK & BELI --}}
            <div>
                <h1 class="text-3xl font-bold mb-2" style="color: #07213C;">{{ $product->name }}</h1>
                <div class="flex items-center mb-4">
                    <p class="text-2xl font-extrabold" style="color: #ECBF62;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if($product->original_price)
                        <p class="text-lg line-through ml-3" style="color: #9CA3AF;">Rp {{ number_format($product->original_price, 0, ',', '.') }}</p>
                    @endif
                </div>
                <p class="mb-2" style="color: #6B7280;">{{ $product->description }}</p>
                <p class="text-sm mb-6" style="color: #ECBF62;">Kategori: 
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
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="flex items-center space-x-2">
                                <label for="quantity" class="text-sm font-medium" style="color: #07213C;">Jumlah:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded-md px-3 py-2 w-20 focus:outline-none focus:ring-2 focus:border-0" style="border-color: #E1E2E4; focus-ring-color: #ECBF62; color: #07213C;">
                            </div>
                            
                            {{-- Tombol Add to Cart --}}
                            <button type="submit" class="px-6 py-3 text-white rounded-lg font-semibold transition duration-300 shadow-md" style="background-color: #ECBF62; color: #07213C;">
                                🛒 Tambah ke Keranjang
                            </button>
                        </div>
                    @else
                        {{-- Notifikasi Sold Out --}}
                        <div class="mb-6 p-4 rounded-lg" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3);">
                            <p class="text-2xl font-bold text-center" style="color: #EF4444;">Produk ini sedang habis.</p>
                            <p class="text-center mt-2" style="color: #EF4444;">Silakan cek kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
                        </div>
                    @endif
                    
                    <p class="text-sm" style="color: #6B7280;">Stok Tersisa: 
                        <span class="font-bold" style="color: {{ $isSoldOut ? '#EF4444' : '#10B981' }};">
                            {{ $isSoldOut ? '0 (HABIS)' : $product->stock }}
                        </span>
                    </p>
                </form>

            </div>
        </div>

        {{-- BAGIAN PRODUK SERUPA (Related Products) --}}
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6" style="color: #07213C;">Produk Serupa</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($relatedProducts as $related)
                    @php $relatedSoldOut = $related->stock <= 0; @endphp
                    
                    {{-- Menggunakan card style yang sama dengan Home Page dengan kondisi sold out --}}
                    <{{ $relatedSoldOut ? 'div' : 'a' }} 
                        @if(!$relatedSoldOut) href="{{ route('product.show', $related->id) }}" @endif
                        class="block card rounded-lg transition duration-300 overflow-hidden
                               {{ $relatedSoldOut ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-xl' }}">
                         <div class="h-48 flex items-center justify-center overflow-hidden relative" style="background-color: #E1E2E4;">
                            @if($related->image)
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                            @else
                                <span style="color: #6B7280;">{{ $related->name }}</span>
                            @endif
                            
                            @if($relatedSoldOut)
                                <div class="absolute inset-0 bg-opacity-75 flex items-center justify-center" style="background-color: rgba(239, 68, 68, 0.75);">
                                    <span class="text-white text-lg font-black rotate-45 border-4 border-white px-3 py-1">SOLD OUT</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold truncate" style="color: #07213C;">{{ $related->name }}</h3>
                            <p class="text-sm mt-1" style="color: #ECBF62;">
                                @if($related->category)
                                    {{ $related->category->name }}
                                @else
                                    Tidak berkategori
                                @endif
                            </p>
                            <p class="text-sm mt-1" style="color: #6B7280;">Stok: 
                                <span class="font-bold" style="color: {{ $relatedSoldOut ? '#EF4444' : '#10B981' }};">
                                    {{ $relatedSoldOut ? 'HABIS' : $related->stock }}
                                </span>
                            </p>
                            <div class="flex items-center mt-2">
                                <span class="text-xl font-bold" style="color: #07213C;">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                @if($related->original_price)
                                    <span class="text-sm line-through ml-2" style="color: #9CA3AF;">Rp {{ number_format($related->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                    </{{ $relatedSoldOut ? 'div' : 'a' }}>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p style="color: #6B7280;">Belum ada produk serupa tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>
</x-app-layout>