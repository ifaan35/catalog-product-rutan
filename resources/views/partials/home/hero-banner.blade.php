{{-- Hero Banner --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, #072138 0%, #0a2d42 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-24">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="flex-1 text-center lg:text-left mb-8 lg:mb-0">
                <p class="text-xs sm:text-sm uppercase font-semibold mb-3 tracking-wide" style="color: #F3C32A;">Social Enterprise</p>
                <h1 class="hero-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4 sm:mb-6">
                    RUTAN<br class="hidden sm:block">
                    <span style="color: #F3C32A;">SHOP</span>
                </h1>
                <p class="text-base sm:text-lg mb-6 sm:mb-8 max-w-md mx-auto lg:mx-0" style="color: #DFE1E3;">
                    Hasil karya berkualitas dari warga binaan. Amplang, Bakpia, Telur segar, dan produk unggulan lainnya.
                </p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center font-bold py-3 px-6 sm:py-4 sm:px-8 text-sm sm:text-base rounded-full transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:opacity-90" style="background-color: #F3C32A; color: #072138;">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    SHOP NOW
                </a>
            </div>
            <div class="flex-1 lg:pl-12 mt-8 lg:mt-0">
                {{-- Hero Image Container --}}
                <div class="relative">
                    <div class="w-full h-64 sm:h-80 lg:h-96 bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl overflow-hidden flex items-center justify-center p-4">
                        {{-- Menggunakan nama file yang Anda upload --}}
                        <img src="{{ asset('images/hero/banner-utama.png') }}" 
                             alt="RUTAN Shop Hero Image" 
                             class="max-w-full max-h-full object-contain rounded-lg"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        
                        {{-- Fallback jika gambar tidak ditemukan --}}
                        <div class="w-full h-full flex items-center justify-center text-center text-white" style="display: none;">
                            <div>
                                <svg class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <p class="text-sm sm:text-base lg:text-lg font-medium opacity-75">Upload Hero Image</p>
                            </div>
                        </div>
                    </div>
                    {{-- Decorative elements --}}
                    <div class="absolute -top-4 -right-4 w-24 h-24 rounded-full opacity-20" style="background-color: #F3C32A;"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 rounded-full opacity-15" style="background-color: #DFE1E3;"></div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Background decoration --}}
    <div class="absolute inset-0 bg-black opacity-5"></div>
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-20 left-10 w-2 h-2 rounded-full opacity-30" style="background-color: #F3C32A;"></div>
        <div class="absolute top-40 right-20 w-3 h-3 rounded-full opacity-25" style="background-color: #DFE1E3;"></div>
        <div class="absolute bottom-32 left-1/4 w-1 h-1 bg-white rounded-full opacity-40"></div>
    </div>
</div>