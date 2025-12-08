<!-- Hero Banner Section -->
<div class="hero-banner overflow-hidden" style="background: linear-gradient(135deg, #07213C 0%, #0d2949 100%); padding: 80px 16px; position: relative;">
    <!-- Decorative elements -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background-color: rgba(236, 191, 98, 0.1); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -100px; left: -80px; width: 400px; height: 400px; background-color: rgba(236, 191, 98, 0.05); border-radius: 50%;"></div>
    
    <div class="max-w-7xl mx-auto text-center relative z-10">
        <!-- Icon/Emoji -->
        <div class="text-6xl mb-6 animate-bounce">🎯</div>
        
        <!-- Main Heading -->
        <h1 class="text-5xl sm:text-6xl font-bold text-white mb-6 leading-tight">
            Belanja Produk <span style="color: #ECBF62;">Pilihan Terbaik</span>
        </h1>
        
        <!-- Subheading -->
        <p class="text-lg sm:text-xl text-white mb-8 max-w-3xl mx-auto leading-relaxed" style="opacity: 0.95;">
            Temukan koleksi lengkap produk berkualitas tinggi hasil karya warga binaan kami. 
            <br class="hidden sm:block">
            Setiap pembelian Anda mendukung program pemberdayaan ekonomi masyakat lokal.
        </p>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('products.index') }}" class="inline-block font-bold py-4 px-10 rounded-lg transition duration-300 hover:shadow-lg hover:scale-105 transform" style="background-color: #ECBF62; color: #07213C; min-width: 200px;">
                🛍️ Mulai Belanja
            </a>
            <a href="#categories" class="inline-block font-bold py-4 px-10 rounded-lg transition duration-300 hover:shadow-lg transform" style="border: 2px solid #ECBF62; color: #ECBF62; min-width: 200px; background-color: transparent;">
                📂 Lihat Kategori
            </a>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mt-16">
            <div>
                <div class="text-3xl sm:text-4xl font-bold" style="color: #ECBF62;">500+</div>
                <p class="text-sm text-white mt-2" style="opacity: 0.8;">Produk Tersedia</p>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-bold" style="color: #ECBF62;">5000+</div>
                <p class="text-sm text-white mt-2" style="opacity: 0.8;">Pelanggan Puas</p>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-bold" style="color: #ECBF62;">100%</div>
                <p class="text-sm text-white mt-2" style="opacity: 0.8;">Garansi Kualitas</p>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-bold" style="color: #ECBF62;">24/7</div>
                <p class="text-sm text-white mt-2" style="opacity: 0.8;">Dukungan Pelanggan</p>
            </div>
        </div>
    </div>
</div>
