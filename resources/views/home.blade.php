{{-- resources/views/home.blade.php --}}

<x-app-layout>
    <div class="min-h-screen" style="background-color: #F5F6F8;">
        
        {{-- 1. Hero Section --}}
        <section class="pb-0">
            @include('partials.home.hero-banner')
        </section>

        {{-- Main Content --}}
        <div class="relative">
            
            {{-- 2. Featured Products Section --}}
            <section class="py-16 sm:py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold mb-3" style="color: #07213C;">
                            ⭐ Produk Unggulan
                        </h2>
                        <p class="text-lg" style="color: #6B7280;">
                            Pilihan terbaik dari koleksi kami
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse($trendingProducts as $product)
                            @php $isSoldOut = $product->stock <= 0; @endphp
                            <div class="group" style="opacity: {{ $isSoldOut ? '0.5' : '1' }};">
                                <a href="{{ route('product.show', $product->id) }}" class="block bg-white rounded-xl shadow-md overflow-hidden transition duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                                    <!-- Product Image -->
                                    <div class="relative overflow-hidden bg-gray-100 h-56" style="background-color: #E1E2E4;">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="flex items-center justify-center h-full">
                                                <span style="color: #9CA3AF;">No Image</span>
                                            </div>
                                        @endif
                                        
                                        {{-- Badge --}}
                                        @if($product->is_trending)
                                            <div class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold" style="background-color: #ECBF62; color: #07213C;">
                                                🔥 Trending
                                            </div>
                                        @endif
                                        
                                        @if($isSoldOut)
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                                <span class="text-white font-bold text-lg">SOLD OUT</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="p-5">
                                        <h3 class="text-lg font-bold truncate mb-2" style="color: #07213C;">
                                            {{ $product->name }}
                                        </h3>
                                        
                                        <p class="text-sm mb-3" style="color: #ECBF62;">
                                            {{ $product->category?->name ?? 'Uncategorized' }}
                                        </p>
                                        
                                        <div class="flex items-baseline gap-2 mb-3">
                                            <span class="text-2xl font-bold" style="color: #07213C;">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            @if($product->original_price)
                                                <span class="text-sm line-through" style="color: #9CA3AF;">
                                                    Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm" style="color: #6B7280;">
                                                Stok: <span class="font-bold" style="color: {{ $product->stock > 5 ? '#10B981' : '#F59E0B' }};">{{ $product->stock }}</span>
                                            </span>
                                            @if(!$isSoldOut)
                                                <form action="{{ route('cart.store', $product) }}" method="POST" onclick="event.stopPropagation();">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="px-3 py-2 rounded-lg transition duration-300 text-sm font-bold" style="background-color: #ECBF62; color: #07213C;">
                                                        🛒 Add
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-4 text-center py-12">
                                <p style="color: #6B7280;">Belum ada produk unggulan</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="text-center mt-12">
                        <a href="{{ route('products.index') }}" class="inline-block font-bold py-3 px-8 rounded-lg transition duration-300 hover:shadow-lg hover:scale-105" style="background-color: #ECBF62; color: #07213C;">
                            Lihat Semua Produk →
                        </a>
                    </div>
                </div>
            </section>
            
            {{-- 3. Section Kategori --}}
            <section class="py-16 sm:py-20" style="background-color: #F5F6F8;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold mb-3" style="color: #07213C;">
                            📂 Jelajahi Kategori
                        </h2>
                        <p class="text-lg" style="color: #6B7280;">
                            Temukan produk berdasarkan kategori
                        </p>
                    </div>
                    
                    @if($categories->count())
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                            @foreach($categories as $category)
                                <a href="{{ route('products.category', $category->slug) }}" class="group bg-white rounded-xl p-8 text-center shadow-md transition duration-300 transform hover:-translate-y-2 hover:shadow-xl border-2 border-transparent hover:border-b-4" style="hover:border-color: #ECBF62;">
                                    <!-- Category Icon -->
                                    <div class="text-5xl mb-4 inline-block p-4 rounded-full transition duration-300" style="background-color: rgba(236, 191, 98, 0.1); group-hover:background-color: rgba(236, 191, 98, 0.2);">
                                        @switch($category->name)
                                            @case('Peternakan')
                                                🐄
                                            @break
                                            @case('Perikanan')
                                                🐟
                                            @break
                                            @case('Pertanian')
                                                🌾
                                            @break
                                            @default
                                                📦
                                        @endswitch
                                    </div>
                                    
                                    <h3 class="text-xl font-bold mb-2" style="color: #07213C;">
                                        {{ $category->name }}
                                    </h3>
                                    <p class="text-sm" style="color: #6B7280;">
                                        {{ $category->products_count }} produk
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
            
            {{-- 4. Section Keunggulan --}}
            <section class="py-16 sm:py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold mb-3" style="color: #07213C;">
                            ✨ Mengapa Pilih RUTAN SHOP?
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="text-4xl mb-4">✅</div>
                            <h3 class="text-lg font-bold mb-2" style="color: #07213C;">Kualitas Terjamin</h3>
                            <p style="color: #6B7280;">Setiap produk telah melalui quality control ketat</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-4xl mb-4">🚚</div>
                            <h3 class="text-lg font-bold mb-2" style="color: #07213C;">Pengiriman Cepat</h3>
                            <p style="color: #6B7280;">Gratis ongkir untuk pembelian di atas Rp 100rb</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-4xl mb-4">💯</div>
                            <h3 class="text-lg font-bold mb-2" style="color: #07213C;">100% Aman</h3>
                            <p style="color: #6B7280;">Pembayaran terenkripsi dan terpercaya</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-4xl mb-4">❤️</div>
                            <h3 class="text-lg font-bold mb-2" style="color: #07213C;">Bantu UMKM</h3>
                            <p style="color: #6B7280;">Setiap pembelian mendukung ekonomi lokal</p>
                        </div>
                    </div>
                </div>
            </section>
            
            {{-- 5. CTA Section --}}
            <section class="py-16 sm:py-20" style="background: linear-gradient(135deg, #07213C 0%, #0d2949 100%);">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                        Siap Memulai Belanja?
                    </h2>
                    <p class="text-lg text-white mb-8" style="opacity: 0.9;">
                        Jangan lewatkan koleksi lengkap produk berkualitas tinggi dengan harga terbaik
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-block font-bold py-4 px-10 rounded-lg transition duration-300 hover:shadow-lg hover:scale-105" style="background-color: #ECBF62; color: #07213C;">
                        Belanja Sekarang 🛍️
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>