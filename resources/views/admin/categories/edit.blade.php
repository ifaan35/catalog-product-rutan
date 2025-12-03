@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-[#072138]">Edit Kategori</h1>
            <p class="text-gray-600 mt-2">Ubah informasi kategori "{{ $category->name }}"</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="max-w-2xl">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-[#072138] mb-2">
                    <i class="fas fa-tag mr-2"></i>Nama Kategori
                </label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#F3C32A] focus:border-[#F3C32A] transition duration-200 @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama kategori"
                       value="{{ old('name', $category->name) }}"
                       required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>Nama kategori harus unik dan tidak boleh sama dengan kategori lain
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
                          placeholder="Jelaskan tentang kategori ini">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    <i class="fas fa-lightbulb mr-1"></i>Deskripsi akan membantu administrator dan pengunjung memahami jenis produk dalam kategori ini
                </p>
            </div>

            <!-- Current Information -->
            <div class="bg-[#DFE1E3] p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-[#072138] mb-3">
                    <i class="fas fa-info mr-2"></i>Informasi Kategori Saat Ini
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Slug Saat Ini:</p>
                        <p class="font-medium text-[#072138]">{{ $category->slug }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Jumlah Produk:</p>
                        <p class="font-medium text-[#072138]">{{ $category->products_count ?? 0 }} produk</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Dibuat:</p>
                        <p class="font-medium text-[#072138]">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Terakhir Diubah:</p>
                        <p class="font-medium text-[#072138]">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="bg-[#DFE1E3] p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-[#072138] mb-3">
                    <i class="fas fa-eye mr-2"></i>Preview Perubahan
                </h3>
                <div class="bg-white p-4 rounded-lg border">
                    <div class="flex items-center mb-2">
                        <div class="w-3 h-3 bg-[#F3C32A] rounded-full mr-3"></div>
                        <h4 class="font-medium text-[#072138]" id="preview-name">{{ $category->name }}</h4>
                    </div>
                    <p class="text-sm text-gray-600" id="preview-description">{{ $category->description }}</p>
                    <p class="text-xs text-gray-400 mt-2">Slug baru: <span id="preview-slug">{{ $category->slug }}</span></p>
                </div>
            </div>

            <!-- Warning if has products -->
            @if($category->products_count > 0)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                Perhatian: Kategori ini memiliki {{ $category->products_count }} produk
                            </h3>
                            <p class="text-sm text-yellow-700 mt-1">
                                Perubahan nama kategori akan mempengaruhi tampilan produk-produk yang terkait. 
                                Pastikan perubahan yang Anda lakukan sudah sesuai.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" 
                        class="bg-[#F3C32A] hover:bg-yellow-500 text-[#072138] font-semibold px-8 py-3 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Perbarui Kategori
                </button>
            </div>
        </form>
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
        const name = nameInput.value || '{{ $category->name }}';
        const description = descriptionInput.value || '{{ $category->description }}';
        const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        
        previewName.textContent = name;
        previewDescription.textContent = description;
        previewSlug.textContent = slug || '{{ $category->slug }}';
    }
    
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
});
</script>
@endsection