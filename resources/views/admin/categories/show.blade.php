@extends('layouts.admin')

@section('title', 'Detail Kategori: ' . $category->name)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[#072138]">Detail Kategori</h1>
                <p class="text-gray-600 mt-2">Informasi lengkap kategori dan produk-produk di dalamnya</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.categories.edit', $category) }}" 
                   class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                    <i class="fas fa-edit mr-2"></i>Edit Kategori
                </a>
                <a href="{{ route('admin.categories.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Category Info -->
        <div class="bg-[#DFE1E3] p-6 rounded-lg">
            <div class="flex items-start">
                <div class="w-4 h-4 bg-[#F3C32A] rounded-full mt-1 mr-4 flex-shrink-0"></div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-[#072138] mb-2">{{ $category->name }}</h2>
                    <p class="text-gray-700 mb-4">{{ $category->description }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Slug:</p>
                            <p class="font-medium text-[#072138]">{{ $category->slug }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Total Produk:</p>
                            <p class="font-medium text-[#072138]">{{ $products->total() }} produk</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Dibuat:</p>
                            <p class="font-medium text-[#072138]">{{ $category->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Terakhir Diubah:</p>
                            <p class="font-medium text-[#072138]">{{ $category->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products in Category -->
    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-2xl font-bold text-[#072138]">Produk dalam Kategori "{{ $category->name }}"</h3>
                <p class="text-gray-600 mt-1">{{ $products->total() }} produk ditemukan</p>
            </div>
            <a href="{{ route('admin.products.create', ['category' => $category->id]) }}" 
               class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                <i class="fas fa-plus mr-2"></i>Tambah Produk
            </a>
        </div>

        @if($products->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <!-- Product Image -->
                        <div class="relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Stock Status -->
                            @if($product->stock <= 0)
                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    Habis
                                </div>
                            @elseif($product->stock <= 5)
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    Terbatas
                                </div>
                            @endif

                            <!-- Trending Badge -->
                            @if($product->is_trending)
                                <div class="absolute top-2 left-2 bg-[#F3C32A] text-[#072138] px-2 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-fire mr-1"></i>Trending
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h4 class="font-semibold text-[#072138] text-lg mb-2 truncate">{{ $product->name }}</h4>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                            
                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <span class="text-xl font-bold text-[#072138]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Stock Info -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm text-gray-500">Stok:</span>
                                <span class="text-sm font-medium 
                                    @if($product->stock <= 0) text-red-500 
                                    @elseif($product->stock <= 5) text-yellow-500 
                                    @else text-green-500 
                                    @endif">
                                    {{ $product->stock }} unit
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="flex-1 bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] text-sm font-medium py-2 px-3 rounded-lg text-center transition duration-200">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-3 rounded-lg transition duration-200">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="flex flex-col items-center">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada produk dalam kategori ini</h3>
                    <p class="text-gray-500 mb-6">Tambahkan produk pertama untuk kategori "{{ $category->name }}"</p>
                    <a href="{{ route('admin.products.create', ['category' => $category->id]) }}" 
                       class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>Tambah Produk Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100">
                <i class="fas fa-boxes text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Produk</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $products->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Produk Tersedia</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $products->where('stock', '>', 0)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Produk Habis</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $products->where('stock', '<=', 0)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#F3C32A] bg-opacity-20">
                <i class="fas fa-fire text-[#F3C32A] text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Produk Trending</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $products->where('is_trending', true)->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection