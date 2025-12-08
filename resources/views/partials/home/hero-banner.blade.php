<!-- Hero Banner Section -->
<div class="hero-banner overflow-hidden"
    style="
        background: linear-gradient(135deg, #07213C 0%, #0D2949 100%);
        padding: 60px 20px;
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
    ">
    
    <!-- Decorative Circles -->
    <div style="position: absolute; top: -70px; right: -70px; width: 320px; height: 320px; 
                background-color: rgba(236, 191, 98, 0.12); border-radius: 50%;">
    </div>

    <div style="position: absolute; bottom: -120px; left: -100px; width: 420px; height: 420px; 
                background-color: rgba(236, 191, 98, 0.06); border-radius: 50%;">
    </div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div>
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6"
                    style="background-color: rgba(236, 191, 98, 0.22); border: 1px solid #ECBF62;">
                    <span style="color: #ECBF62;">⭐</span>
                    <span style="color: #ECBF62; font-weight: 600; font-size: 14px;">Belanja Produk Berkualitas</span>
                </div>

                <!-- Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Rutan <span style="color: #ECBF62;">Shop</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base text-white mb-8 leading-relaxed" style="opacity: 0.95;">
                    Temukan ribuan produk pilihan berkualitas tinggi. Dari peternakan, perikanan, hingga pertanian.
                    Semua ada di sini dengan harga terjangkau dan pengiriman cepat ke seluruh Indonesia.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center gap-2 font-bold py-3 px-8 rounded-lg transition duration-300 
                        hover:shadow-lg hover:scale-105 transform text-center"
                        style="background-color: #ECBF62; color: #07213C; font-size: 14px;">
                        <span>📦</span>
                        <span>Mulai Belanja Sekarang</span>
                    </a>

                    <a href="#categories"
                        class="inline-flex items-center justify-center gap-2 font-bold py-3 px-8 rounded-lg transition duration-300 
                        hover:shadow-lg transform text-center"
                        style="border: 2px solid #ECBF62; color: #ECBF62; background-color: transparent; font-size: 14px;">
                        <span>📂</span>
                        <span>Pelajari Lebih Lanjut</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="hidden lg:flex justify-center items-center">
                <div style="position: relative; width: 100%; max-width: 520px;">
                    <div
                        style="
                            background: linear-gradient(135deg, rgba(200,200,200,0.9) 0%, rgba(160,160,160,0.9) 100%);
                            border-radius: 24px;
                            padding: 80px 40px;
                            width: 100%;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                            backdrop-filter: blur(10px);
                        ">

                        <!-- Icon -->
                        <div style="font-size: 100px; margin-bottom: 24px; opacity: 0.9;">📦</div>

                        <!-- Title -->
                        <h3 style="color: #07213C; font-size: 32px; font-weight: 700; margin-bottom: 8px; text-align: center;">
                            Produk Premium
                        </h3>

                        <p style="color: #07213C; opacity: 0.65; font-size: 14px; text-align: center;">Kualitas terjamin & terpercaya</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- STATS ROW - Bottom (Desktop) -->
        <div class="hidden lg:flex justify-start items-center gap-16 mt-16 border-t pt-8" style="border-color: rgba(236, 191, 98, 0.2);">
            <div class="text-left">
                <div style="color: #ECBF62; font-size: 48px; font-weight: 900; line-height: 1;">500+</div>
                <p style="color: white; font-size: 14px; opacity: 0.8; margin-top: 6px;">Produk</p>
            </div>

            <div class="text-left">
                <div style="color: #ECBF62; font-size: 48px; font-weight: 900; line-height: 1;">10K+</div>
                <p style="color: white; font-size: 14px; opacity: 0.8; margin-top: 6px;">Pelanggan</p>
            </div>

            <div class="text-left">
                <div style="color: #ECBF62; font-size: 48px; font-weight: 900; line-height: 1;">24/7</div>
                <p style="color: white; font-size: 14px; opacity: 0.8; margin-top: 6px;">Support</p>
            </div>
        </div>

        <!-- STATS ROW (Mobile) -->
        <div class="lg:hidden grid grid-cols-3 gap-4 mt-12 border-t pt-6" style="border-color: rgba(236, 191, 98, 0.2);">
            <div class="text-center">
                <div style="color: #ECBF62; font-size: 32px; font-weight: 900; line-height: 1;">500+</div>
                <p style="color: white; font-size: 12px; opacity: 0.8; margin-top: 4px;">Produk</p>
            </div>

            <div class="text-center">
                <div style="color: #ECBF62; font-size: 32px; font-weight: 900; line-height: 1;">10K+</div>
                <p style="color: white; font-size: 12px; opacity: 0.8; margin-top: 4px;">Pelanggan</p>
            </div>

            <div class="text-center">
                <div style="color: #ECBF62; font-size: 32px; font-weight: 900; line-height: 1;">24/7</div>
                <p style="color: white; font-size: 12px; opacity: 0.8; margin-top: 4px;">Support</p>
            </div>
        </div>
    </div>
</div>
