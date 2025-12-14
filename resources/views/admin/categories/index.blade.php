@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#072138]">Manajemen Kategori</h1>
            <p class="text-gray-600 mt-2">Kelola kategori produk RUTARO SHOP</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Tambah Kategori
        </a>
    </div>

    <!-- Session Messages -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Categories Table -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#DFE1E3]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#072138] uppercase tracking-wider">
                            <i class="fas fa-hashtag mr-2"></i>ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#072138] uppercase tracking-wider">
                            <i class="fas fa-tag mr-2"></i>Nama Kategori
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#072138] uppercase tracking-wider">
                            <i class="fas fa-info-circle mr-2"></i>Deskripsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#072138] uppercase tracking-wider">
                            <i class="fas fa-boxes mr-2"></i>Jumlah Produk
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#072138] uppercase tracking-wider">
                            <i class="fas fa-calendar mr-2"></i>Dibuat
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-[#072138] uppercase tracking-wider">
                            <i class="fas fa-cogs mr-2"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $category->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-[#F3C32A] rounded-full mr-3"></div>
                                    <div>
                                        <div class="text-sm font-medium text-[#072138]">{{ $category->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $category->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs">
                                    {{ Str::limit($category->description, 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($category->products_count > 0) 
                                        bg-green-100 text-green-800
                                    @else 
                                        bg-gray-100 text-gray-800
                                    @endif">
                                    <i class="fas fa-box mr-1"></i>{{ $category->products_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <i class="fas fa-clock mr-1"></i>{{ $category->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="inline-flex items-center px-3 py-2 border border-[#072138] text-[#072138] text-xs font-medium rounded-md hover:bg-[#072138] hover:text-white transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="inline-flex items-center px-3 py-2 border border-[#F3C32A] text-[#F3C32A] text-xs font-medium rounded-md hover:bg-[#F3C32A] hover:text-[#072138] transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Produk yang terkait akan kehilangan kategorinya.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 border border-red-500 text-red-500 text-xs font-medium rounded-md hover:bg-red-500 hover:text-white transition-colors duration-200">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kategori</h3>
                                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan kategori pertama untuk produk RUTARO SHOP.</p>
                                    <a href="{{ route('admin.categories.create') }}" 
                                       class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                        <i class="fas fa-plus mr-2"></i>Tambah Kategori Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#F3C32A] bg-opacity-20">
                <i class="fas fa-tags text-[#F3C32A] text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-[#072138]">Total Kategori</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $categories->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100">
                <i class="fas fa-boxes text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-[#072138]">Kategori Aktif</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $categories->where('products_count', '>', 0)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100">
                <i class="fas fa-folder text-red-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-[#072138]">Kategori Kosong</h3>
                <p class="text-2xl font-bold text-[#072138]">{{ $categories->where('products_count', 0)->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection