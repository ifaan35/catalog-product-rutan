{{-- Quick Categories Section --}}
<div class="text-center">
    <h2 class="text-2xl sm:text-3xl font-bold mb-3" style="color: #07213C;">🏦 Kategori Populer</h2>
    <p class="text-sm sm:text-base mb-8 sm:mb-12 px-4" style="color: #6B7280;">Jelajahi produk hasil karya warga binaan berdasarkan sektor unggulan</p>
    
    <div class="card-grid grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 max-w-4xl mx-auto">
        @php
            $categoryIcons = [
                'Peternakan' => '🐄',
                'Perikanan' => '🐟', 
                'Pertanian' => '🌾'
            ];
            $categoryDescriptions = [
                'Peternakan' => 'Produk Ternak Segar',
                'Perikanan' => 'Hasil Laut & Air Tawar',
                'Pertanian' => 'Hasil Bumi Organik'
            ];
        @endphp
        
        @forelse($categories as $category)
            <a href="{{ route('products.category', $category->slug) }}" class="group card rounded-lg p-4 sm:p-6 text-center hover:shadow-lg transition duration-300 transform hover:-translate-y-1" style="border: 2px solid transparent;">
                <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 transition duration-300" style="background-color: rgba(236, 191, 98, 0.15);">
                    <span class="text-xl sm:text-2xl">{{ $categoryIcons[$category->name] ?? '📦' }}</span>
                </div>
                <h3 class="text-sm sm:text-base font-semibold" style="color: #07213C;">{{ ucfirst(strtolower($category->name)) }}</h3>
                <p class="text-xs sm:text-sm" style="color: #6B7280;">{{ $categoryDescriptions[$category->name] ?? $category->description }}</p>
            </a>
        @empty
            {{-- Fallback jika belum ada kategori --}}
            <div class="col-span-3 text-center py-8">
                <p style="color: #9CA3AF;">Kategori belum tersedia</p>
            </div>
        @endforelse
    </div>
</div>