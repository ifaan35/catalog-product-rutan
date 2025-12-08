{{-- Quick Categories Section --}}
<div class="text-center">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-3">🏦 Kategori Populer</h2>
    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-8 sm:mb-12 px-4">Jelajahi produk hasil karya warga binaan berdasarkan sektor unggulan</p>
    
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
            <a href="{{ route('products.category', $category->slug) }}" class="group bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 text-center hover:shadow-lg transition duration-300 transform hover:-translate-y-1 border-2 border-transparent hover:border-pink-300 dark:hover:border-pink-600">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-pink-100 dark:bg-pink-900 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 transition duration-300 group-hover:bg-pink-200 dark:group-hover:bg-pink-800">
                    <span class="text-xl sm:text-2xl">{{ $categoryIcons[$category->name] ?? '📦' }}</span>
                </div>
                <h3 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">{{ $categoryDescriptions[$category->name] ?? $category->description }}</p>
            </a>
        @empty
            {{-- Fallback jika belum ada kategori --}}
            <div class="col-span-3 text-center py-8">
                <p class="text-gray-500">Kategori belum tersedia</p>
            </div>
        @endforelse
    </div>
</div>