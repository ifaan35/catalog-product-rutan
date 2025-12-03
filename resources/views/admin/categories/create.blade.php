@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-[#072138]">Tambah Kategori Baru</h1>
            <p class="text-gray-600 mt-2">Buat kategori baru untuk mengorganisir produk RUTAN SHOP</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-[#072138] mb-2">
                    <i class="fas fa-tag mr-2"></i>Nama Kategori
                </label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#F3C32A] focus:border-[#F3C32A] transition duration-200 @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama kategori (contoh: Peternakan, Perikanan, Pertanian)"
                       value="{{ old('name') }}"
                       required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>Nama kategori harus unik dan tidak boleh sama dengan yang sudah ada
                </p>
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="description" class="block text-sm font-medium text-[#072138] mb-2">
                    <i class="fas fa-info-circle mr-2"></i>Deskripsi
                </label>
                <textarea name="description" 
                          id="description"
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#F3C32A] focus:border-[#F3C32A] transition duration-200 @error('description') border-red-500 @enderror"
                          placeholder="Jelaskan tentang kategori ini (contoh: Produk-produk hasil peternakan yang dikelola oleh warga binaan)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    <i class="fas fa-lightbulb mr-1"></i>Deskripsi akan membantu administrator dan pengunjung memahami jenis produk dalam kategori ini
                </p>
            </div>

            <!-- Preview Section -->
            <div class="bg-[#DFE1E3] p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-[#072138] mb-3">
                    <i class="fas fa-eye mr-2"></i>Preview Kategori
                </h3>
                <div class="bg-white p-4 rounded-lg border">
                    <div class="flex items-center mb-2">
                        <div class="w-3 h-3 bg-[#F3C32A] rounded-full mr-3"></div>
                        <h4 class="font-medium text-[#072138]" id="preview-name">Nama kategori akan muncul di sini</h4>
                    </div>
                    <p class="text-sm text-gray-600" id="preview-description">Deskripsi kategori akan muncul di sini</p>
                    <p class="text-xs text-gray-400 mt-2">Slug: <span id="preview-slug">slug-otomatis</span></p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" 
                        class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-8 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Category Examples -->
<div class="mt-8 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <h3 class="text-lg font-semibold text-[#072138] mb-4">
        <i class="fas fa-lightbulb mr-2"></i>Contoh Kategori untuk RUTAN SHOP
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-[#DFE1E3] p-4 rounded-lg">
            <div class="flex items-center mb-2">
                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                <h4 class="font-medium text-[#072138]">Peternakan</h4>
            </div>
            <p class="text-sm text-gray-600">Produk-produk hasil peternakan yang dikelola oleh warga binaan seperti telur, susu, daging, dan produk olahan.</p>
        </div>
        <div class="bg-[#DFE1E3] p-4 rounded-lg">
            <div class="flex items-center mb-2">
                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                <h4 class="font-medium text-[#072138]">Perikanan</h4>
            </div>
            <p class="text-sm text-gray-600">Produk-produk hasil perikanan yang dibudidayakan seperti ikan segar, ikan olahan, dan produk turunannya.</p>
        </div>
        <div class="bg-[#DFE1E3] p-4 rounded-lg">
            <div class="flex items-center mb-2">
                <div class="w-3 h-3 bg-orange-500 rounded-full mr-2"></div>
                <h4 class="font-medium text-[#072138]">Pertanian</h4>
            </div>
            <p class="text-sm text-gray-600">Produk-produk hasil pertanian seperti sayuran, buah-buahan, beras, dan hasil pertanian lainnya.</p>
        </div>
    </div>
</div>

<script>
// Preview functionality
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const previewName = document.getElementById('preview-name');
    const previewDescription = document.getElementById('preview-description');
    const previewSlug = document.getElementById('preview-slug');
    
    function updatePreview() {
        const name = nameInput.value || 'Nama kategori akan muncul di sini';
        const description = descriptionInput.value || 'Deskripsi kategori akan muncul di sini';
        const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        
        previewName.textContent = name;
        previewDescription.textContent = description;
        previewSlug.textContent = slug || 'slug-otomatis';
    }
    
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
});
</script>
@endsection