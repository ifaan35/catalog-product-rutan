<!-- Footer Section -->
<footer style="background-color: #07213C; color: white;">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <!-- Column 1: Brand Info -->
            <div>
                <h3 class="text-2xl font-bold mb-4" style="color: #ECBF62;">
                    🛍️ RUTAN SHOP
                </h3>
                <p class="text-sm leading-relaxed" style="opacity: 0.9;">
                    Platform belanja online terpercaya untuk produk berkualitas tinggi hasil karya warga binaan. 
                    Dukung ekonomi lokal dengan setiap pembelian Anda.
                </p>
                
                <!-- Social Links -->
                <div class="flex gap-4 mt-6">
                    <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <!-- Column 2: Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-4" style="color: #ECBF62;">
                    Navigasi
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-400 transition duration-300">
                            → Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-yellow-400 transition duration-300">
                            → Semua Produk
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition duration-300">
                            → Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition duration-300">
                            → Blog
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Column 3: Categories -->
            <div>
                <h4 class="text-lg font-bold mb-4" style="color: #ECBF62;">
                    Kategori
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition duration-300">
                            🐄 Peternakan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition duration-300">
                            🐟 Perikanan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition duration-300">
                            🌾 Pertanian
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition duration-300">
                            📦 Lainnya
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Column 4: Contact Info -->
            <div>
                <h4 class="text-lg font-bold mb-4" style="color: #ECBF62;">
                    Hubungi Kami
                </h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex gap-2">
                        <span>📍</span>
                        <span>Jakarta, Indonesia</span>
                    </li>
                    <li class="flex gap-2">
                        <span>📞</span>
                        <span>+62 812 3456 7890</span>
                    </li>
                    <li class="flex gap-2">
                        <span>✉️</span>
                        <span>info@rutanshop.com</span>
                    </li>
                    <li class="flex gap-2">
                        <span>⏰</span>
                        <span>Senin - Jumat: 09:00 - 17:00</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Footer Divider -->
    <div style="border-top: 1px solid rgba(236, 191, 98, 0.3);"></div>
    
    <!-- Bottom Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm">
            <p style="opacity: 0.8;">
                © 2024 RUTAN SHOP. Semua hak dilindungi.
            </p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-yellow-400 transition duration-300">
                    Kebijakan Privasi
                </a>
                <span style="opacity: 0.5;">|</span>
                <a href="#" class="hover:text-yellow-400 transition duration-300">
                    Syarat & Ketentuan
                </a>
                <span style="opacity: 0.5;">|</span>
                <a href="#" class="hover:text-yellow-400 transition duration-300">
                    Bantuan
                </a>
            </div>
        </div>
    </div>
</footer>
