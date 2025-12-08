<!-- Hero Banner Section -->
<div class="hero-banner overflow-hidden" style="background: linear-gradient(135deg, #07213C 0%, #0d2949 100%); padding: 60px 16px 80px; position: relative;">
    <!-- Decorative elements -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background-color: rgba(236, 191, 98, 0.1); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -100px; left: -80px; width: 400px; height: 400px; background-color: rgba(236, 191, 98, 0.05); border-radius: 50%;"></div>
    
    <div class="max-w-7xl mx-auto relative z-10">
        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Column: Content -->
            <div>
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background-color: rgba(236, 191, 98, 0.2); border: 1px solid #ECBF62;">
                    <span style="color: #ECBF62;">⭐</span>
                    <span style="color: #ECBF62; font-weight: 600;">Belanja Produk Berkualitas</span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Rutan <span style="color: #ECBF62;">Shop</span>
                </h1>
                
                <!-- Subheading -->
                <p class="text-base sm:text-lg text-white mb-8 max-w-2xl leading-relaxed" style="opacity: 0.95;">
                    Temukan ribuan produk pilihan berkualitas tinggi. Dari peternakan, perikanan, hingga pertanian. Semua ada di sini dengan harga terjangkau dan pengiriman cepat ke seluruh Indonesia.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-12">
                    <a href="{{ route('products.index') }}" class="inline-block font-bold py-3 px-8 rounded-lg transition duration-300 hover:shadow-lg hover:scale-105 transform text-center" style="background-color: #ECBF62; color: #07213C;">
                        📦 Mulai Belanja Sekarang
                    </a>
                    <a href="#categories" class="inline-block font-bold py-3 px-8 rounded-lg transition duration-300 hover:shadow-lg transform text-center" style="border: 2px solid #ECBF62; color: #ECBF62; background-color: transparent;">
                        📂 Pelajari Lebih Lanjut
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="border-l-4" style="border-color: #ECBF62; padding-left: 1rem;">
                        <div class="text-2xl sm:text-3xl font-black" style="color: #ECBF62;">500+</div>
                        <p class="text-xs sm:text-sm text-white mt-1" style="opacity: 0.8;">Produk</p>
                    </div>
                    <div class="border-l-4" style="border-color: #ECBF62; padding-left: 1rem;">
                        <div class="text-2xl sm:text-3xl font-black" style="color: #ECBF62;">10K+</div>
                        <p class="text-xs sm:text-sm text-white mt-1" style="opacity: 0.8;">Pelanggan</p>
                    </div>
                    <div class="border-l-4" style="border-color: #ECBF62; padding-left: 1rem;">
                        <div class="text-2xl sm:text-3xl font-black" style="color: #ECBF62;">24/7</div>
                        <p class="text-xs sm:text-sm text-white mt-1" style="opacity: 0.8;">Support</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Illustration Card -->
            <div class="hidden lg:flex justify-center items-center">
                <div style="position: relative; width: 100%; aspect-ratio: 1;">
                    <!-- Decorative circles in background -->
                    <div style="position: absolute; top: 20px; right: 20px; width: 150px; height: 150px; background-color: rgba(236, 191, 98, 0.15); border-radius: 50%; filter: blur(40px);"></div>
                    <div style="position: absolute; bottom: -30px; left: -30px; width: 200px; height: 200px; background-color: rgba(236, 191, 98, 0.1); border-radius: 50%; filter: blur(50px);"></div>
                    
                    <!-- Main Card -->
                    <div style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(236, 191, 98, 0.3); border-radius: 20px; padding: 40px; position: absolute; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);">
                        <!-- Package Icon -->
                        <div style="font-size: 80px; margin-bottom: 24px;">📦</div>
                        
                        <!-- Card Title -->
                        <h3 style="color: #07213C; font-size: 24px; font-weight: 700; margin-bottom: 8px;">Produk Premium</h3>
                        <p style="color: #07213C; opacity: 0.6; font-size: 14px;">Kualitas terjamin & terpercaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
