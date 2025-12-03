{{-- resources/views/orders/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6" style="color: #072138;">Riwayat Pesanan Saya</h1>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg">
            <div class="p-6">
                
                @if($orders->isEmpty())
                    <div class="text-center py-12">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pesanan</h3>
                        <p class="text-gray-500 mb-4">Yuk mulai berbelanja produk-produk berkualitas dari warga binaan RUTAN!</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 rounded-full font-bold transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1" style="background-color: #F3C32A; color: #072138;">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Mulai Belanja
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead style="background-color: #072138;">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No. Order</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order->created_at->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $order->created_at->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($order->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3"/>
                                                    </svg>
                                                    Menunggu
                                                </span>
                                            @elseif($order->status == 'processing')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3"/>
                                                    </svg>
                                                    Diproses
                                                </span>
                                            @elseif($order->status == 'delivered')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3"/>
                                                    </svg>
                                                    Selesai
                                                </span>
                                            @elseif($order->status == 'shipped')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3"/>
                                                    </svg>
                                                    Dikirim
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium transition duration-300 hover:shadow-md" style="background-color: #F3C32A; color: #072138;">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>