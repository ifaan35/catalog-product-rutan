{{-- resources/views/admin/products/index.blade.php --}}
@php use Illuminate\Support\Facades\Storage; @endphp

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold" style="color: #072138;">Manajemen Produk RUTARO SHOP</h1>
            <a href="{{ route('admin.products.create') }}" class="font-bold py-2 px-4 rounded-md transition duration-300" style="background-color: #F3C32A; color: #072138;">
                + Tambah Produk Baru
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg sm:rounded-lg overflow-hidden" style="border: 1px solid #DFE1E3;">
            <table class="min-w-full divide-y" style="border-color: #DFE1E3;">
                <thead style="background-color: #072138;">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y" style="border-color: #DFE1E3;">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->image)
                                    <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" class="h-10 w-10 object-cover rounded-full">
                                @else
                                    <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-xs text-gray-500">No Img</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium" style="color: #072138;">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $product->stock < 10 ? 'text-red-600' : 'text-green-600' }}">{{ $product->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-1 rounded text-white transition duration-300" style="background-color: #072138;">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $product->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4" style="background-color: #DFE1E3;">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>