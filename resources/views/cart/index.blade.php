<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Keranjang Belanja</h1>

        @if(empty($cart))
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center">
                <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">Keranjang Anda kosong</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg">
                    Lanjutkan Belanja
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-gray-900 dark:text-white font-semibold">Produk</th>
                                    <th class="px-6 py-3 text-left text-gray-900 dark:text-white font-semibold">Harga</th>
                                    <th class="px-6 py-3 text-left text-gray-900 dark:text-white font-semibold">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-gray-900 dark:text-white font-semibold">Total</th>
                                    <th class="px-6 py-3 text-left text-gray-900 dark:text-white font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($cart as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($item['image'])
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded mr-4">
                                                @endif
                                                <span class="text-gray-900 dark:text-white">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="number" value="{{ $item['quantity'] }}" min="1" class="w-16 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 dark:bg-gray-700 dark:text-white">
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-white font-semibold">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="POST" action="{{ route('cart.destroy') }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>Pengiriman</span>
                                <span>-</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-bold text-gray-900 dark:text-white mb-6">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-4 rounded-lg text-center block transition duration-300">
                            Lanjut ke Pembayaran
                        </a>

                        <a href="{{ route('products.index') }}" class="w-full mt-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-bold py-3 px-4 rounded-lg text-center block transition duration-300">
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
