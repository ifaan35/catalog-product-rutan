<!-- Hero Banner Section -->
<div class="hero-banner overflow-hidden" style="background: linear-gradient(135deg, #07213C 0%, #0d2949 100%); padding: 40px 16px 60px; position: relative; min-height: 100vh; display: flex; align-items: center;">
    <!-- Decorative elements -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background-color: rgba(236, 191, 98, 0.1); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -100px; left: -80px; width: 400px; height: 400px; background-color: rgba(236, 191, 98, 0.05); border-radius: 50%;"></div>
    
    <div class="max-w-7xl mx-auto relative z-10 w-full">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
            <!-- Left Column: Text Content -->
            <div class="lg:col-span-1">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background-color: rgba(236, 191, 98, 0.2); border: 1px solid #ECBF62;">
                    <span style="color: #ECBF62;">⭐</span>
                    <span style="color: #ECBF62; font-weight: 600; font-size: 14px;">Belanja Produk Berkualitas</span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6 leading-tight">
                    Rutan <span style="color: #ECBF62;">Shop</span>
                </h1>
                
                <!-- Subheading -->
                <p class="text-base text-white mb-8 leading-relaxed" style="opacity: 0.95;">
                    Temukan ribuan produk pilihan berkualitas tinggi. Dari peternakan, perikanan, hingga pertanian. Semua ada di sini dengan harga terjangkau dan pengiriman cepat ke seluruh Indonesia.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('products.index') }}" class="inline-block font-bold py-3 px-8 rounded-lg transition duration-300 hover:shadow-lg hover:scale-105 transform text-center" style="background-color: #ECBF62; color: #07213C; font-size: 14px;">
                        📦 Mulai Belanja Sekarang
                    </a>
                    <a href="#categories" class="inline-block font-bold py-3 px-8 rounded-lg transition duration-300 hover:shadow-lg transform text-center" style="border: 2px solid #ECBF62; color: #ECBF62; background-color: transparent; font-size: 14px;">
                        📂 Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            
            <!-- Middle Column: Stats -->
            <div class="hidden lg:flex flex-col justify-center items-center gap-8">
                <div class="text-center">
                    <div style="color: #ECBF62; font-size: 48px; font-weight: 900;">500+</div>
                    <p style="color: white; font-size: 14px; opacity: 0.8; margin-top: 8px;">Produk</p>
                </div>
                <div class="text-center">
                    <div style="color: #ECBF62; font-size: 48px; font-weight: 900;">10K+</div>
                    <p style="color: white; font-size: 14px; opacity: 0.8; margin-top: 8px;">Pelanggan</p>
                </div>
                <div class="text-center">
                    <div style="color: #ECBF62; font-size: 48px; font-weight: 900;">24/7</div>
                    <p style="color: white; font-size: 14px; opacity: 0.8; margin-top: 8px;">Support</p>
                </div>
            </div>
            
            <!-- Right Column: Illustration Card -->
            <div class="hidden lg:flex justify-center items-center lg:col-span-1">
                <div style="position: relative; width: 100%; height: 350px;">
                    <!-- Main Card with Gold Border -->
                    <div style="background: linear-gradient(135deg, rgba(200, 200, 200, 0.8) 0%, rgba(170, 170, 170, 0.8) 100%); border: 3px solid #ECBF62; border-radius: 16px; padding: 40px; position: absolute; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);">
                        <!-- Package Icon -->
                        <div style="font-size: 48px; margin-bottom: 24px; opacity: 0.6;">📦</div>
                        
                        <!-- Card Title -->
                        <h3 style="color: #07213C; font-size: 20px; font-weight: 700; margin-bottom: 8px;">Produk Premium</h3>
                        <p style="color: #07213C; opacity: 0.6; font-size: 13px;">Kualitas terjamin & terpercaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
