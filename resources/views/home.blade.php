{{-- resources/views/home.blade.php --}}

<x-app-layout>
    <div class="min-h-screen" style="background-color: #F5F6F8;">
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-50px); }
                to { opacity: 1; transform: translateX(0); }
            }
            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(50px); }
                to { opacity: 1; transform: translateX(0); }
            }
            .float-animation {
                animation: float 3s ease-in-out infinite;
            }
            .slide-in-left {
                animation: slideInLeft 0.8s ease-out;
            }
            .slide-in-right {
                animation: slideInRight 0.8s ease-out;
            }
        </style>
        
        {{-- 1. Hero Section --}}
        <section style="background: linear-gradient(135deg, #07213C 0%, #0d2949 50%, #1a3a5c 100%); padding: 100px 0; position: relative; overflow: hidden;">
            <!-- Decorative Elements -->
            <div class="absolute top-10 right-10 w-72 h-72 rounded-full opacity-10" style="background-color: #ECBF62;"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full opacity-5" style="background-color: #ECBF62;"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Left Content --}}
                    <div class="slide-in-left">
                        <div class="mb-6 inline-block">
                            <span class="px-5 py-3 rounded-full text-sm font-semibold shadow-lg" style="background-color: rgba(236, 191, 98, 0.25); color: #ECBF62; backdrop-filter: blur(10px);">
                                ⭐ Belanja Produk Berkualitas
                            </span>
                        </div>
                        <h1 class="text-5xl sm:text-7xl font-black mb-6 leading-tight" style="color: white;">
                            Rutan <span style="color: #ECBF62;">Shop</span>
                        </h1>
                        <p class="text-lg leading-relaxed mb-10 opacity-90" style="color: rgba(255,255,255,0.9);">
                            Temukan ribuan produk pilihan berkualitas tinggi. Dari peternakan, perikanan, hingga pertanian. Semua ada di sini dengan harga terjangkau dan pengiriman cepat ke seluruh Indonesia.
                        </p>
                        <div class="flex gap-4 flex-wrap">
                            <a href="{{ route('products.index') }}" class="px-8 py-4 rounded-xl font-bold transition duration-300 transform hover:shadow-2xl hover:scale-105" style="background: linear-gradient(135deg, #ECBF62 0%, #f5d07f 100%); color: #07213C;">
                                🛍️ Mulai Belanja Sekarang
                            </a>
                            <a href="#" class="px-8 py-4 rounded-xl font-bold border-2 transition duration-300 hover:bg-white hover:bg-opacity-20" style="border-color: #ECBF62; color: white;">
                                📚 Pelajari Lebih Lanjut
                            </a>
                        </div>

                        <!-- Stats Section -->
                        <div class="grid grid-cols-3 gap-6 mt-12">
                            <div class="text-center border-l-2" style="border-color: #ECBF62;">
                                <p class="text-3xl font-black" style="color: #ECBF62;">500+</p>
                                <p class="text-sm opacity-75" style="color: white;">Produk</p>
                            </div>
                            <div class="text-center border-l-2" style="border-color: #ECBF62;">
                                <p class="text-3xl font-black" style="color: #ECBF62;">10K+</p>
                                <p class="text-sm opacity-75" style="color: white;">Pelanggan</p>
                            </div>
                            <div class="text-center border-l-2" style="border-color: #ECBF62;">
                                <p class="text-3xl font-black" style="color: #ECBF62;">24/7</p>
                                <p class="text-sm opacity-75" style="color: white;">Support</p>
                            </div>
                        </div>
                    </div>

                    {{-- Right Hero Image --}}
                    <div class="flex items-center justify-center relative slide-in-right">
                        <div class="absolute w-80 h-80 rounded-full opacity-20 float-animation" style="background-color: #ECBF62; right: -40px; top: -40px;"></div>
                        <div class="relative z-10 w-full h-96 rounded-3xl flex items-center justify-center shadow-2xl" style="background: linear-gradient(135deg, rgba(225, 226, 228, 0.95), rgba(236, 191, 98, 0.15)); backdrop-filter: blur(10px); border: 2px solid rgba(236, 191, 98, 0.3);">
                            <div class="text-center">
                                <div class="text-8xl mb-4 float-animation">📦</div>
                                <p class="font-bold text-xl" style="color: #07213C;">Produk Premium</p>
                                <p class="text-sm opacity-70 mt-2" style="color: #6B7280;">Kualitas Terjamin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <div class="relative">
            
            {{-- 2. Featured Products Section --}}
            <section class="py-24 sm:py-32" style="background: linear-gradient(180deg, #F5F6F8 0%, white 100%);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-20">
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold mb-4" style="background-color: rgba(236, 191, 98, 0.15); color: #ECBF62;">
                            🏆 PILIHAN TERBAIK
                        </span>
                        <h2 class="text-5xl sm:text-6xl font-black mb-6" style="color: #07213C;">
                            Produk <span style="color: #ECBF62;">Unggulan</span>
                        </h2>
                        <p class="text-xl opacity-70" style="color: #6B7280;">
                            Koleksi produk terpopuler dengan rating terbaik dari pelanggan
                        </p>
                        <div class="w-24 h-1 mx-auto mt-6" style="background: linear-gradient(90deg, #ECBF62 0%, transparent 100%);"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @forelse($trendingProducts as $product)
                            @php $isSoldOut = $product->stock <= 0; @endphp
                            <div class="group h-full" style="opacity: {{ $isSoldOut ? '0.6' : '1' }};">
                                <a href="{{ route('product.show', $product->id) }}" class="block bg-white rounded-3xl shadow-lg overflow-hidden transition-all duration-300 transform hover:-translate-y-4 hover:shadow-3xl h-full border border-gray-100">
                                    <!-- Product Image -->
                                    <div class="relative overflow-hidden h-64" style="background: linear-gradient(135deg, #E1E2E4 0%, #d9dadc 100%);">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="flex items-center justify-center h-full text-5xl">📦</div>
                                        @endif
                                        
                                        {{-- Badge --}}
                                        @if($product->is_trending)
                                            <div class="absolute top-4 right-4 px-4 py-2 rounded-full text-xs font-bold shadow-lg" style="background-color: #ECBF62; color: #07213C;">
                                                🔥 Trending
                                            </div>
                                        @endif
                                        
                                        @if($isSoldOut)
                                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                                <span class="text-white font-black text-lg">SOLD OUT</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="p-6">
                                        <p class="text-xs font-black mb-3 opacity-60 tracking-wider" style="color: #ECBF62; text-transform: uppercase;">
                                            {{ $product->category?->name ?? 'Uncategorized' }}
                                        </p>
                                        <h3 class="text-lg font-bold mb-3 line-clamp-2 group-hover:text-yellow-600 transition" style="color: #07213C;">
                                            {{ $product->name }}
                                        </h3>
                                        
                                        <div class="flex items-baseline gap-2 mb-4">
                                            <span class="text-3xl font-black" style="color: #ECBF62;">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            @if($product->original_price)
                                                <span class="text-sm line-through opacity-50" style="color: #6B7280;">
                                                    Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <span class="text-sm font-semibold" style="color: #6B7280;">
                                                📦 <span style="color: {{ $product->stock > 5 ? '#10B981' : '#F59E0B' }};">{{ $product->stock }} stok</span>
                                            </span>
                                            @if(!$isSoldOut)
                                                <form action="{{ route('cart.store', $product) }}" method="POST" onclick="event.stopPropagation();">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="px-4 py-2 rounded-lg transition-all duration-300 text-sm font-bold hover:shadow-lg hover:scale-105" style="background-color: #ECBF62; color: #07213C;">
                                                        🛒 Add
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-4 text-center py-20">
                                <p class="text-2xl opacity-50" style="color: #6B7280;">Belum ada produk unggulan</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="text-center mt-16">
                        <a href="{{ route('products.index') }}" class="inline-block font-bold py-4 px-12 rounded-xl transition-all duration-300 hover:shadow-xl hover:scale-105 transform" style="background: linear-gradient(135deg, #07213C 0%, #0d2949 100%); color: white;">
                            Lihat Semua Produk →
                        </a>
                    </div>
                </div>
            </section>
            {{-- 3. Section Kategori --}}
            <section class="py-16 sm:py-20" style="background-color: white;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl sm:text-5xl font-black mb-6" style="color: #07213C;">
                            Jelajahi <span style="color: #ECBF62;">Kategori</span>
                        </h2>
                        <p class="text-lg opacity-70 max-w-2xl mx-auto" style="color: #6B7280;">
                            Temukan produk yang Anda cari dari berbagai kategori pilihan
                        </p>
                    </div>

                    <div class="flex justify-center items-center gap-32 flex-wrap max-w-4xl mx-auto">
                        @foreach([
                            ['name' => 'peternakan', 'emoji' => '🐄'],
                            ['name' => 'perikanan', 'emoji' => '🐟'],
                            ['name' => 'pertanian', 'emoji' => '🌾']
                        ] as $cat)
                            <div class="group cursor-pointer text-center transform transition-all duration-300 hover:scale-110">
                                <!-- Circular Badge -->
                                <div class="w-36 h-36 rounded-full mx-auto mb-6 flex items-center justify-center text-6xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-2" style="background-color: #D3D4D7;">
                                    {{ $cat['emoji'] }}
                                </div>

                                <!-- Category Name -->
                                <p class="text-sm font-semibold transition duration-300" style="color: #07213C;">
                                    {{ $cat['name'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>