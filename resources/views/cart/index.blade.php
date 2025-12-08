<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style="background-color: #F5F6F8;">
        <h1 class="text-3xl font-bold mb-8" style="color: #07213C;">Keranjang Belanja</h1>

        @if(empty($cart))
            <div class="card rounded-lg p-8 text-center">
                <p class="text-lg mb-4" style="color: #6B7280;">Keranjang Anda kosong</p>
                <a href="{{ route('products.index') }}" class="inline-block text-white font-bold py-2 px-6 rounded-lg" style="background-color: #ECBF62; color: #07213C;">
                    Lanjutkan Belanja
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="card rounded-lg overflow-hidden">
                        <table class="w-full">
                            <thead style="background-color: #07213C;">
                                <tr>
                                    <th class="px-6 py-3 text-left text-white font-semibold">Produk</th>
                                    <th class="px-6 py-3 text-left text-white font-semibold">Harga</th>
                                    <th class="px-6 py-3 text-left text-white font-semibold">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-white font-semibold">Total</th>
                                    <th class="px-6 py-3 text-left text-white font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #E1E2E4;" class="divide-y">
                                @foreach($cart as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($item['image'])
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded mr-4">
                                                @endif
                                                <span style="color: #07213C;">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4" style="color: #07213C;">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="number" value="{{ $item['quantity'] }}" min="1" class="w-16 border rounded px-2 py-1" style="border-color: #E1E2E4; color: #07213C;">
                                        </td>
                                        <td class="px-6 py-4 font-semibold" style="color: #ECBF62;">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="POST" action="{{ route('cart.destroy') }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                <button type="submit" class="text-sm font-semibold" style="color: #EF4444;">
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
                    <div class="card rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-6" style="color: #07213C;">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-6 pb-6" style="border-bottom-color: #E1E2E4;" class="border-b">
                            <div class="flex justify-between" style="color: #6B7280;">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between" style="color: #6B7280;">
                                <span>Pengiriman</span>
                                <span>-</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-bold mb-6" style="color: #07213C;">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="w-full text-white font-bold py-3 px-4 rounded-lg text-center block transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                            Lanjut ke Pembayaran
                        </a>

                        <a href="{{ route('products.index') }}" class="w-full mt-3 font-bold py-3 px-4 rounded-lg text-center block transition duration-300" style="background-color: #E1E2E4; color: #07213C;">
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
