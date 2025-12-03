{{-- resources/views/home.blade.php --}}

<x-app-layout>
    {{-- Container utama --}}
    <div class="min-h-screen" style="background-color: #DFE1E3;">
        
        {{-- 1. Hero Section / Banner Utama --}}
        <section class="pb-0">
            @include('partials.home.hero-banner')
        </section>

        {{-- Main Content Container --}}
        <div class="relative">
            
            {{-- 2. Section Kategori / Navigasi Cepat --}}
            <section class="section-padding py-12 sm:py-16 bg-white" id="categories">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @include('partials.home.quick-categories')
                </div>
            </section>

            {{-- 3. Section Produk Trending --}}
            <section class="section-padding py-12 sm:py-16" style="background-color: #DFE1E3;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @include('partials.home.trending-products')
                </div>
            </section>

            {{-- 4. Section Layanan Kami --}}
            <section class="section-padding py-12 sm:py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @include('partials.home.our-services')
                </div>
            </section>

        </div>
    </div>
</x-app-layout>