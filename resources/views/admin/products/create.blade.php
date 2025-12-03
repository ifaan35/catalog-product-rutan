{{-- resources/views/admin/products/create.blade.php --}}

<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6" style="color: #072138;">Tambah Produk Baru</h1>
        
        <div class="bg-white shadow sm:rounded-lg p-6" style="border: 1px solid #DFE1E3;">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                
                @include('admin.products.form')

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                    <button type="submit" class="font-bold py-2 px-4 rounded transition duration-300" style="background-color: #F3C32A; color: #072138;">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>