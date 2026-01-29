{{-- resources/views/about.blade.php --}}

<x-app-layout>
    <!-- Hero Section -->
    <div class="overflow-hidden" style="background: linear-gradient(135deg, #07213C 0%, #0D2949 100%); padding: 80px 20px; position: relative;">
        <!-- Decorative Circles -->
        <div style="position: absolute; top: -50px; right: -50px; width: 250px; height: 250px; background-color: rgba(236, 191, 98, 0.1); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 300px; height: 300px; background-color: rgba(236, 191, 98, 0.06); border-radius: 50%;"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background-color: rgba(236, 191, 98, 0.22); border: 1px solid #ECBF62;">
                    <span style="color: #ECBF62;">✨</span>
                    <span style="color: #ECBF62; font-weight: 600; font-size: 14px;">Tentang Kami</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Karya <span style="color: #ECBF62;">Nyata</span>,<br>Dukungan <span style="color: #ECBF62;">Nyata</span>
                </h1>
                
                <p class="text-lg text-white mx-auto max-w-3xl leading-relaxed" style="opacity: 0.95;">
                    Platform e-commerce yang memberdayakan warga binaan Rutan melalui penjualan hasil karya berkualitas tinggi. 
                    Setiap pembelian Anda adalah langkah nyata menuju reintegrasi sosial yang lebih baik.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16" style="background-color: #F5F6F8;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Misi Kami Section -->
            <div class="mb-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Text Content -->
                    <div>
                        <div class="inline-block px-4 py-2 rounded-lg mb-4" style="background-color: rgba(236, 191, 98, 0.15);">
                            <span style="color: #07213C; font-weight: 700; font-size: 14px;">MISI KAMI</span>
                        </div>
                        
                        <h2 class="text-3xl sm:text-4xl font-bold mb-6" style="color: #07213C;">
                            Memberdayakan <span style="color: #ECBF62;">Masa Depan</span>
                        </h2>
                        
                        <p class="text-lg mb-6 leading-relaxed" style="color: #6B7280;">
                            RUTARO SHOP adalah lebih dari sekadar toko online. Ini adalah platform yang didedikasikan untuk 
                            mendukung reintegrasi sosial warga binaan melalui hasil karya dan keterampilan yang mereka pelajari 
                            di dalam Rutan.
                        </p>
                        
                        <!-- Mission Points -->
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 p-4 rounded-lg" style="background-color: white;">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #ECBF62;">
                                    <svg class="w-6 h-6" style="color: #07213C;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1" style="color: #07213C;">Keterampilan Vokasi Nyata</h3>
                                    <p style="color: #6B7280;">Memberikan pelatihan praktis di bidang peternakan, perikanan, dan pertanian yang bermanfaat.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 rounded-lg" style="background-color: white;">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #ECBF62;">
                                    <svg class="w-6 h-6" style="color: #07213C;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1" style="color: #07213C;">Kemandirian Finansial</h3>
                                    <p style="color: #6B7280;">Menanamkan rasa tanggung jawab dan memberikan penghasilan yang layak untuk masa depan mereka.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 rounded-lg" style="background-color: white;">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #ECBF62;">
                                    <svg class="w-6 h-6" style="color: #07213C;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1" style="color: #07213C;">Jembatan Kepercayaan</h3>
                                    <p style="color: #6B7280;">Membangun kepercayaan dan hubungan positif antara warga binaan dengan masyarakat luas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image/Visual -->
                    <div class="relative">
                        <div class="rounded-2xl overflow-hidden shadow-2xl" style="background: linear-gradient(135deg, #07213C 0%, #0D2949 100%);">
                            <div class="p-12 text-center">
                                <div class="text-8xl mb-6">🤝</div>
                                <h3 class="text-3xl font-bold text-white mb-4">Bersama Membangun</h3>
                                <p class="text-white" style="opacity: 0.9;">Setiap produk yang Anda beli adalah investasi untuk masa depan yang lebih baik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kualitas Produk Section -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <div class="inline-block px-4 py-2 rounded-lg mb-4" style="background-color: rgba(236, 191, 98, 0.15);">
                        <span style="color: #07213C; font-weight: 700; font-size: 14px;">KOMITMEN KAMI</span>
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4" style="color: #07213C;">
                        Kualitas yang Lahir dari <span style="color: #ECBF62;">Dedikasi</span>
                    </h2>
                    
                    <p class="text-lg max-w-3xl mx-auto" style="color: #6B7280;">
                        Meskipun produk dibuat di dalam Rutan, kualitas adalah prioritas utama kami. 
                        Setiap produk melewati standar ketat untuk memastikan kepuasan Anda.
                    </p>
                </div>
                
                <!-- Quality Points Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center p-8 rounded-xl transition duration-300 hover:shadow-xl hover:-translate-y-2" style="background-color: white;">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6" style="background-color: rgba(236, 191, 98, 0.15);">
                            <span class="text-4xl">🌿</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3" style="color: #07213C;">Segar & Higienis</h3>
                        <p style="color: #6B7280;">Langsung dari sumber dengan standar kebersihan yang terjamin dan terkontrol</p>
                    </div>
                    
                    <div class="text-center p-8 rounded-xl transition duration-300 hover:shadow-xl hover:-translate-y-2" style="background-color: white;">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6" style="background-color: rgba(236, 191, 98, 0.15);">
                            <span class="text-4xl">🔍</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3" style="color: #07213C;">Proses Terkontrol</h3>
                        <p style="color: #6B7280;">Dari bahan baku hingga pengemasan diawasi ketat oleh petugas ahli</p>
                    </div>
                    
                    <div class="text-center p-8 rounded-xl transition duration-300 hover:shadow-xl hover:-translate-y-2" style="background-color: white;">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6" style="background-color: rgba(236, 191, 98, 0.15);">
                            <span class="text-4xl">💰</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3" style="color: #07213C;">Harga Terjangkau</h3>
                        <p style="color: #6B7280;">Harga wajar untuk mendukung program, bukan mencari keuntungan maksimal</p>
                    </div>
                    
                    <div class="text-center p-8 rounded-xl transition duration-300 hover:shadow-xl hover:-translate-y-2" style="background-color: white;">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6" style="background-color: rgba(236, 191, 98, 0.15);">
                            <span class="text-4xl">✅</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3" style="color: #07213C;">Terpercaya</h3>
                        <p style="color: #6B7280;">Didukung oleh Kementerian Hukum dan HAM Republik Indonesia</p>
                    </div>
                </div>
            </div>

            <!-- Impact Section -->
            <div class="mb-20">
                <div class="rounded-3xl p-12 shadow-2xl" style="background: linear-gradient(135deg, #07213C 0%, #0D2949 100%); position: relative; overflow: hidden;">
                    <!-- Decorative Elements -->
                    <div style="position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background-color: rgba(236, 191, 98, 0.1); border-radius: 50%;"></div>
                    <div style="position: absolute; bottom: -40px; left: -40px; width: 180px; height: 180px; background-color: rgba(236, 191, 98, 0.08); border-radius: 50%;"></div>
                    
                    <div class="relative z-10">
                        <div class="text-center mb-12">
                            <div class="inline-block px-4 py-2 rounded-lg mb-4" style="background-color: rgba(236, 191, 98, 0.22); border: 1px solid #ECBF62;">
                                <span style="color: #ECBF62; font-weight: 700; font-size: 14px;">DAMPAK NYATA</span>
                            </div>
                            
                            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                                Setiap Pembelian Adalah<br>Investasi <span style="color: #ECBF62;">Kebaikan</span>
                            </h2>
                            
                            <p class="text-lg text-white max-w-3xl mx-auto" style="opacity: 0.9;">
                                Uang yang Anda bayarkan tidak hanya untuk produk berkualitas, tetapi juga untuk masa depan yang lebih cerah bagi warga binaan
                            </p>
                        </div>
                        
                        <!-- Statistics -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="text-center p-6 rounded-xl" style="background-color: rgba(236, 191, 98, 0.1); backdrop-filter: blur(10px);">
                                <div class="text-5xl font-black mb-2" style="color: #ECBF62;">10+</div>
                                <p class="text-white font-semibold">Warga Binaan Terlatih</p>
                            </div>
                            
                            <div class="text-center p-6 rounded-xl" style="background-color: rgba(236, 191, 98, 0.1); backdrop-filter: blur(10px);">
                                <div class="text-5xl font-black mb-2" style="color: #ECBF62;">100+</div>
                                <p class="text-white font-semibold">Produk Terjual</p>
                            </div>
                            
                            <div class="text-center p-6 rounded-xl" style="background-color: rgba(236, 191, 98, 0.1); backdrop-filter: blur(10px);">
                                <div class="text-5xl font-black mb-2" style="color: #ECBF62;">95%</div>
                                <p class="text-white font-semibold">Tingkat Kepuasan</p>
                            </div>
                        </div>
                        
                        <!-- Impact Points -->
                        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #ECBF62;">
                                    <svg class="w-5 h-5" style="color: #07213C;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white mb-1">Upah & Insentif</h4>
                                    <p class="text-white text-sm" style="opacity: 0.8;">Sebagian dana kembali sebagai upah untuk warga binaan</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #ECBF62;">
                                    <svg class="w-5 h-5" style="color: #07213C;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white mb-1">Pengembangan Fasilitas</h4>
                                    <p class="text-white text-sm" style="opacity: 0.8;">Digunakan untuk meningkatkan peralatan dan pelatihan</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #ECBF62;">
                                    <svg class="w-5 h-5" style="color: #07213C;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white mb-1">Persiapan Reintegrasi</h4>
                                    <p class="text-white text-sm" style="opacity: 0.8;">Membantu mereka siap kembali ke masyarakat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Section -->
            <div class="mb-20">
                <div class="max-w-4xl mx-auto">
                    <div class="rounded-2xl p-12 shadow-xl" style="background-color: white; position: relative;">
                        <!-- Large Quote Mark -->
                        <div class="absolute top-8 left-8 text-8xl" style="color: rgba(236, 191, 98, 0.2); font-family: Georgia, serif; line-height: 0;">"</div>
                        
                        <div class="relative z-10 pl-16">
                            <p class="text-2xl font-medium mb-8 leading-relaxed" style="color: #07213C;">
                                Program ini tidak hanya memberikan keterampilan, tetapi juga mengembalikan kepercayaan diri dan harapan untuk masa depan yang lebih baik. Setiap produk yang terjual adalah bukti bahwa masyarakat percaya pada kemampuan mereka.
                            </p>
                            
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-xl font-bold" style="background-color: #ECBF62; color: #07213C;">
                                    PK
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg" style="color: #07213C;">Pak Kusuma</h4>
                                    <p style="color: #6B7280;">Petugas Pembinaan Rutan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center">
                <div class="inline-block rounded-2xl p-12 shadow-2xl" style="background: linear-gradient(135deg, #ECBF62 0%, #D4A84F 100%);">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4" style="color: #07213C;">
                        Siap Menjadi Bagian dari Perubahan?
                    </h2>
                    <p class="text-lg mb-8 max-w-2xl mx-auto" style="color: #07213C; opacity: 0.85;">
                        Mulai belanja sekarang dan rasakan kepuasan ganda: produk berkualitas dan kontribusi nyata untuk masa depan yang lebih baik
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl font-bold text-lg transition duration-300 hover:shadow-2xl hover:scale-105 transform" style="background-color: #07213C; color: #ECBF62;">
                        <span class="text-2xl">🛍️</span>
                        <span>Belanja Sekarang dan Dukung Misi Kami</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
