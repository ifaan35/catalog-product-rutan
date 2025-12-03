{{-- resources/views/checkout/history.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" style="background-color: #DFE1E3;">
        <h1 class="text-3xl font-bold mb-8" style="color: #072138;">Riwayat Pesanan</h1>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <!-- Order Header -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 pb-4 border-b" style="border-color: #DFE1E3;">
                            <div>
                                <h3 class="text-xl font-bold" style="color: #072138;">{{ $order->order_number }}</h3>
                                <p class="text-sm" style="color: #072138; opacity: 0.6;">
                                    Tanggal: {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div class="text-right mt-2 md:mt-0">
                                <div class="flex flex-col md:flex-row gap-2">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($order->status == 'pending') text-yellow-800 bg-yellow-100
                                        @elseif($order->status == 'processing') text-blue-800 bg-blue-100
                                        @elseif($order->status == 'shipped') text-purple-800 bg-purple-100
                                        @elseif($order->status == 'delivered') text-green-800 bg-green-100
                                        @else text-red-800 bg-red-100
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($order->payment_status == 'paid') text-green-800 bg-green-100
                                        @elseif($order->payment_status == 'unpaid') text-red-800 bg-red-100
                                        @else text-gray-800 bg-gray-100
                                        @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="space-y-3 mb-4">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 rounded-lg overflow-hidden" style="background-color: #DFE1E3;">
                                            @if($item->product && $item->product->image_url)
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #072138; opacity: 0.5;">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-semibold" style="color: #072138;">{{ $item->product_name }}</h4>
                                            <p class="text-sm" style="color: #072138; opacity: 0.6;">
                                                Ukuran: {{ $item->size }} | Qty: {{ $item->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold" style="color: #F3C32A;">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs" style="color: #072138; opacity: 0.6;">
                                            @ Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Summary -->
                        <div class="border-t pt-4 flex justify-between items-center" style="border-color: #DFE1E3;">
                            <div>
                                <p class="text-sm" style="color: #072138; opacity: 0.6;">
                                    Dikirim ke: {{ $order->recipient_name }}
                                </p>
                                <p class="text-xs" style="color: #072138; opacity: 0.5;">
                                    {{ $order->phone_number }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold" style="color: #072138;">
                                    Total: <span style="color: #F3C32A;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #F3C32A; background-opacity: 0.1;">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #072138;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: #072138;">Belum Ada Pesanan</h3>
                <p class="mb-6" style="color: #072138; opacity: 0.6;">Anda belum melakukan pemesanan apapun</p>
                <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 rounded-lg font-semibold text-white transition duration-300 hover:opacity-90" style="background-color: #072138;">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</x-app-layout>