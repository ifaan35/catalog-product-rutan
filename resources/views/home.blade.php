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
    </div>
</x-app-layout>