{{-- resources/views/checkout/history.blade.php --}}

<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style="background-color: #F5F6F8; min-height: 100vh;">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2" style="color: #07213C;">Riwayat Pesanan</h1>
            <p style="color: #6B7280;">Lihat dan kelola semua pesanan Anda</p>
        </div>

        @if($orders->isEmpty())
            <div class="card rounded-lg p-12 text-center">
                <div class="text-6xl mb-4">📦</div>
                <h2 class="text-2xl font-bold mb-2" style="color: #07213C;">Belum Ada Pesanan</h2>
                <p class="mb-6" style="color: #6B7280;">Mulai berbelanja sekarang dan lihat pesanan Anda di sini</p>
                <a href="{{ route('products.index') }}" class="inline-block font-bold py-3 px-6 rounded-lg transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                    🛍️ Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="card rounded-lg p-6 hover:shadow-lg transition duration-300">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                            <!-- Order Number -->
                            <div>
                                <p class="text-sm font-semibold mb-1" style="color: #6B7280;">NOMOR PESANAN</p>
                                <p class="font-bold text-lg" style="color: #07213C;">{{ $order->order_number }}</p>
                            </div>

                            <!-- Date -->
                            <div>
                                <p class="text-sm font-semibold mb-1" style="color: #6B7280;">TANGGAL</p>
                                <p class="font-bold text-lg" style="color: #07213C;">{{ $order->created_at->format('d M Y') }}</p>
                            </div>

                            <!-- Status -->
                            <div>
                                <p class="text-sm font-semibold mb-1" style="color: #6B7280;">STATUS</p>
                                <div class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->status === 'delivered') 
                                        {{ 'bg-green-100 text-green-800' }}
                                    @elseif($order->status === 'shipped')
                                        {{ 'bg-blue-100 text-blue-800' }}
                                    @else
                                        {{ 'bg-yellow-100 text-yellow-800' }}
                                    @endif">
                                    @if($order->status === 'pending')
                                        ⏳ Menunggu
                                    @elseif($order->status === 'shipped')
                                        🚚 Dikirim
                                    @elseif($order->status === 'delivered')
                                        ✅ Diterima
                                    @else
                                        ❌ Dibatalkan
                                    @endif
                                </div>
                            </div>

                            <!-- Total -->
                            <div>
                                <p class="text-sm font-semibold mb-1" style="color: #6B7280;">TOTAL</p>
                                <p class="font-bold text-lg" style="color: #ECBF62;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div style="border-top-color: #E1E2E4;" class="border-t pt-4">
                            <p class="text-sm mb-3" style="color: #6B7280;">
                                <strong>Dikirim ke:</strong> {{ $order->recipient_name }} - {{ $order->phone_number }}
                            </p>
                            <p class="text-sm mb-4" style="color: #6B7280;">
                                {{ $order->detail_address }}<br>
                                {{ $order->village_name }}, {{ $order->district_name }}<br>
                                {{ $order->regency_name }}, {{ $order->province_name }}
                            </p>

                            <!-- Items Preview -->
                            <div class="mb-4">
                                <p class="text-sm font-semibold mb-2" style="color: #07213C;">{{ $order->orderItems->count() }} Item(s):</p>
                                <div class="space-y-1">
                                    @foreach($order->orderItems->take(2) as $item)
                                        <p class="text-sm" style="color: #6B7280;">
                                            • {{ $item->product_name }} ({{ $item->quantity }}x) - Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </p>
                                    @endforeach
                                    @if($order->orderItems->count() > 2)
                                        <p class="text-sm font-semibold" style="color: #ECBF62;">
                                            + {{ $order->orderItems->count() - 2 }} item(s) lainnya
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <a href="{{ route('checkout.success', $order->id) }}" class="inline-block text-sm font-semibold px-4 py-2 rounded transition" style="background-color: #07213C; color: #FFFFFF;">
                                    📋 Lihat Detail
                                </a>
                                @if($order->status === 'pending')
                                    <span class="inline-block text-sm font-semibold px-4 py-2 rounded" style="background-color: #F3F4F6; color: #6B7280;">
                                        ⏳ Menunggu Konfirmasi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
