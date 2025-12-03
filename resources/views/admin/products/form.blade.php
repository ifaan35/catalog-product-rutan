{{-- resources/views/admin/products/form.blade.php --}}
@php use Illuminate\Support\Facades\Storage; @endphp

<div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm space-y-6">
    {{-- Nama Produk --}}
    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
        <label for="name" class="block text-sm font-medium mb-1" style="color: #072138;">Nama Produk *</label>
        <input id="name" name="name" type="text" class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-opacity-50 p-3 focus:border-yellow-400" style="border-color: #DFE1E3; focus:border-color: #F3C32A; focus:ring-color: #F3C32A;" value="{{ old('name', $product->name ?? '') }}" required autofocus />
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
        <label for="description" class="block text-sm font-medium mb-1" style="color: #072138;">Deskripsi Produk (Opsional)</label>
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-opacity-50 p-3 focus:border-yellow-400" style="border-color: #DFE1E3; focus:border-color: #F3C32A; focus:ring-color: #F3C32A;" placeholder="Masukkan deskripsi produk (opsional)">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Kategori --}}
    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
        <label for="category_id" class="block text-sm font-medium mb-1" style="color: #072138;">Kategori *</label>
        <select id="category_id" name="category_id" class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-opacity-50 p-3 focus:border-yellow-400" style="border-color: #DFE1E3; focus:border-color: #F3C32A; focus:ring-color: #F3C32A;" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <p class="mt-1 text-sm text-gray-600">Pilih kategori yang sesuai untuk produk ini</p>
    </div>

    {{-- Harga & Stok --}}
    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
        <h3 class="text-sm font-medium mb-3" style="color: #072138;">Harga & Stok</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="price" class="block text-sm font-medium mb-1" style="color: #072138;">Harga (Rp) *</label>
                <input id="price" name="price" type="number" class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-opacity-50 p-3 focus:border-yellow-400" style="border-color: #DFE1E3; focus:border-color: #F3C32A; focus:ring-color: #F3C32A;" value="{{ old('price', $product->price ?? '') }}" required min="1000" />
                @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium mb-1" style="color: #072138;">Stok *</label>
                <input id="stock" name="stock" type="number" class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-opacity-50 p-3 focus:border-yellow-400" style="border-color: #DFE1E3; focus:border-color: #F3C32A; focus:ring-color: #F3C32A;" value="{{ old('stock', $product->stock ?? '') }}" required min="0" />
                @error('stock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Gambar --}}
    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
        <label for="image" class="block text-sm font-medium mb-1" style="color: #072138;">Gambar Produk * (Maks 2MB)</label>
        <input id="image" name="image" type="file" class="mt-1 block w-full border-2 border-gray-300 rounded-lg p-3 focus:border-yellow-400" style="border-color: #DFE1E3;" accept="image/*" {{ !isset($product) ? 'required' : '' }} />
        @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if(isset($product) && $product->image)
            <div class="mt-4">
                <p class="text-sm mb-2" style="color: #072138;">Gambar Saat Ini:</p>
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded-lg border" style="border-color: #DFE1E3;">
            </div>
        @endif
    </div>
    
    {{-- Keterangan field wajib --}}
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-800">
            <strong>Keterangan:</strong> Field bertanda <span class="text-red-500">*</span> wajib diisi. Deskripsi produk bersifat opsional.
        </p>
    </div>
</div>