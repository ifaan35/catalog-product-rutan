{{-- resources/views/checkout/success.blade.php --}}

<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style="background-color: #F5F6F8; min-height: 100vh;">
        <!-- Success Card -->
        <div class="card rounded-lg p-8 shadow-lg" style="background-color: #FFFFFF; border-top: 5px solid #10B981;">
            <div class="text-center mb-8">
                <div class="inline-block mb-4">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto" style="background-color: #D1FAE5;">
                        <svg class="w-12 h-12" style="color: #10B981;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold mb-2" style="color: #10B981;">Pesanan Berhasil Dibuat!</h1>
                <p class="text-lg" style="color: #6B7280;">Terima kasih telah berbelanja di RUTARO SHOP</p>
            </div>

            <!-- Order Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8" style="border-bottom-color: #E1E2E4;" class="border-b">
                <!-- Order Number & Status -->
                <div>
                    <p class="text-sm font-semibold mb-1" style="color: #6B7280;">NOMOR PESANAN</p>
                    <p class="text-2xl font-bold" style="color: #07213C;">{{ $order->order_number }}</p>
                    <p class="text-sm mt-3" style="color: #6B7280;">Simpan nomor ini untuk tracking pesanan Anda</p>
                </div>

                <!-- Date & Status -->
                <div>
                    <p class="text-sm font-semibold mb-1" style="color: #6B7280;">TANGGAL PESANAN</p>
                    <p class="text-xl font-bold mb-4" style="color: #07213C;">{{ $order->created_at->format('d M Y H:i') }}</p>
                    <div class="inline-block px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #FEF3C7; color: #92400E;">
                        ⏳ Menunggu Konfirmasi
                    </div>
                </div>
            </div>

            <!-- Recipient Info -->
            <div class="mb-8 pb-8" style="border-bottom-color: #E1E2E4;" class="border-b">
                <h3 class="text-lg font-bold mb-4" style="color: #07213C;">Informasi Pengiriman</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-semibold mb-1" style="color: #6B7280;">Nama Penerima</p>
                        <p style="color: #07213C;">{{ $order->recipient_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold mb-1" style="color: #6B7280;">Nomor Telepon</p>
                        <p style="color: #07213C;">{{ $order->phone_number }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm font-semibold mb-1" style="color: #6B7280;">Alamat Pengiriman</p>
                        <p style="color: #07213C;">
                            {{ $order->detail_address }}<br>
                            {{ $order->village_name }}, {{ $order->district_name }}<br>
                            {{ $order->regency_name }}, {{ $order->province_name }} {{ $order->postal_code }}
                        </p>
                    </div>
                    @if($order->notes)
                        <div class="md:col-span-2">
                            <p class="text-sm font-semibold mb-1" style="color: #6B7280;">Catatan</p>
                            <p style="color: #07213C;">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-8 pb-8" style="border-bottom-color: #E1E2E4;" class="border-b">
                <h3 class="text-lg font-bold mb-4" style="color: #07213C;">Rincian Pesanan</h3>
                <div class="space-y-3">
                    @foreach($order->orderItems as $item)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium" style="color: #07213C;">{{ $item->product_name }}</p>
                                <p class="text-sm" style="color: #6B7280;">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-semibold" style="color: #ECBF62;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Total -->
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div>
                    <p class="text-sm" style="color: #6B7280;">Subtotal</p>
                    <p class="text-lg font-bold" style="color: #07213C;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm" style="color: #6B7280;">Ongkos Kirim</p>
                    <p class="text-lg font-bold" style="color: #10B981;">Gratis</p>
                </div>
            </div>

            <div class="p-4 rounded-lg mb-8" style="background-color: #F0F9FF; border-left: 4px solid #ECBF62;">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold" style="color: #07213C;">Total Pembayaran</span>
                    <span class="text-2xl font-bold" style="color: #ECBF62;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-blue-50 rounded-lg p-4 mb-8" style="background-color: #F3F4F6;">
                <h4 class="font-bold mb-3" style="color: #07213C;">📋 Langkah Selanjutnya</h4>
                
                @if($order->payment_proof)
                    <div class="mb-4 p-3 rounded" style="background-color: #D1FAE5;">
                        <p class="text-sm font-semibold" style="color: #065F46;">✓ Bukti pembayaran telah diunggah</p>
                        <p class="text-xs mt-1" style="color: #047857;">Menunggu verifikasi admin</p>
                    </div>
                    
                    <!-- Preview Bukti Pembayaran -->
                    <div class="mb-4">
                        <p class="text-sm font-semibold mb-2" style="color: #07213C;">Bukti Pembayaran:</p>
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-xs rounded-lg shadow-md">
                    </div>
                @endif

                <ol class="space-y-2" style="color: #6B7280;">
                    @if($order->payment_proof)
                        <li class="text-sm"><span class="font-semibold">1.</span> Bukti pembayaran Anda sedang diverifikasi oleh admin</li>
                        <li class="text-sm"><span class="font-semibold">2.</span> Setelah pembayaran diverifikasi, paket akan disiapkan</li>
                        <li class="text-sm"><span class="font-semibold">3.</span> Anda akan menerima notifikasi pengiriman</li>
                    @else
                        <li class="text-sm"><span class="font-semibold">1.</span> Lakukan pembayaran melalui QRIS yang telah ditampilkan</li>
                        <li class="text-sm"><span class="font-semibold">2.</span> Upload bukti pembayaran pada halaman pembayaran</li>
                        <li class="text-sm"><span class="font-semibold">3.</span> Tunggu verifikasi dari admin</li>
                        <li class="text-sm"><span class="font-semibold">4.</span> Anda akan menerima notifikasi pengiriman</li>
                    @endif
                </ol>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('checkout.history') }}" class="flex-1 text-center font-bold py-3 px-4 rounded-lg transition duration-300" style="background-color: #07213C; color: #FFFFFF;">
                    📦 Lihat Riwayat Pesanan
                </a>
                <a href="{{ route('products.index') }}" class="flex-1 text-center font-bold py-3 px-4 rounded-lg transition duration-300" style="background-color: #E1E2E4; color: #07213C;">
                    🛍️ Lanjutkan Belanja
                </a>
            </div>

            <!-- Contact Info -->
            <div class="mt-8 pt-8" style="border-top-color: #E1E2E4;" class="border-t text-center">
                <p class="text-sm" style="color: #6B7280;">Ada pertanyaan? Hubungi kami di WhatsApp atau Email</p>
                <p class="text-sm font-semibold mt-2" style="color: #07213C;">
                    📞 +62-815-3956-1898 | 📧 info@rutaroshop.com
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
