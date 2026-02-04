{{-- resources/views/admin/orders/show.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold" style="color: #072138;">
                Kelola Pesanan #{{ $order->order_number }}
            </h1>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg border-l-4 border-green-500" style="background-color: #d4edda; color: #155724;">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Status Update Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4" style="color: #072138;">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Update Status Pesanan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Update Status Pesanan -->
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex-1">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Pesanan:</label>
                        <select name="status" id="status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:border-transparent" style="focus:ring-color: #F3C32A;">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                    @switch($status)
                                        @case('pending') ⏳ Menunggu Konfirmasi @break
                                        @case('processing') 🔄 Sedang Diproses @break
                                        @case('shipped') 🚚 Sedang Dikirim @break
                                        @case('delivered') ✅ Sudah Diterima @break
                                        @case('cancelled') ❌ Dibatalkan @break
                                    @endswitch
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 font-bold rounded-md transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1" style="background-color: #F3C32A; color: #072138;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Perbarui Status
                    </button>
                </form>

                <!-- Update Status Pembayaran -->
                <form action="{{ route('admin.orders.updatePaymentStatus', $order->id) }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex-1">
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran:</label>
                        <select name="payment_status" id="payment_status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:border-transparent" style="focus:ring-color: #F3C32A;">
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>❌ Belum Dibayar</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>✅ Sudah Dibayar</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>⚠️ Gagal</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>↩️ Dikembalikan</option>
                        </select>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 font-bold rounded-md transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1" style="background-color: #10B981; color: #FFFFFF;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Update Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Detail Items Pesanan --}}
            <div class="lg:col-span-2 bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-200" style="color: #072138;">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Detail Produk Pesanan
                </h3>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <h4 class="text-lg font-medium text-gray-900">{{ $item->product_name }}</h4>
                                <div class="mt-1 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $item->quantity }} unit
                                    </span>
                                    <span class="mx-2">×</span>
                                    <span class="font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Total Pesanan</span>
                        <span class="text-2xl font-bold" style="color: #F3C32A;">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Pelanggan & Pengiriman --}}
            <div class="space-y-6">
                <!-- Info Pelanggan -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-200" style="color: #072138;">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Info Pelanggan
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full flex items-center justify-center text-white font-bold" style="background-color: #F3C32A; color: #072138;">
                                    {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $order->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="pt-2 border-t border-gray-100">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Bergabung:</span> 
                                {{ $order->user->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Info Pengiriman -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-200" style="color: #072138;">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Detail Pengiriman
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                            <p class="text-gray-900 font-medium">{{ $order->recipient_name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <p class="text-gray-900 font-medium">{{ $order->phone_number }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <p class="text-gray-900 font-medium leading-relaxed bg-gray-50 p-3 rounded">
                                {{ $order->detail_address }}<br>
                                <span class="text-sm">{{ $order->village_name }}, {{ $order->district_name }}</span><br>
                                <span class="text-sm">{{ $order->regency_name }}, {{ $order->province_name }} {{ $order->postal_code }}</span>
                            </p>
                        </div>
                        
                        <div class="pt-2 border-t border-gray-100 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal Order:</span>
                                <span class="text-sm font-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Payment:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $order->payment_status == 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                @if($order->payment_proof)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-200" style="color: #072138;">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Bukti Pembayaran
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Status Pembayaran:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-800' : ($order->payment_status == 'unpaid' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    @switch($order->payment_status)
                                        @case('paid') ✅ Sudah Dibayar @break
                                        @case('unpaid') ⏳ Menunggu Verifikasi @break
                                        @case('failed') ❌ Gagal @break
                                        @case('refunded') ↩️ Dikembalikan @break
                                    @endswitch
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti Transfer:</label>
                            <div class="border-2 border-gray-200 rounded-lg p-2 bg-white">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="w-full h-auto rounded-lg shadow-md cursor-pointer hover:opacity-90 transition"
                                     onclick="window.open(this.src, '_blank')">
                            </div>
                            <p class="mt-2 text-xs text-gray-500 italic">
                                💡 Klik gambar untuk melihat ukuran penuh
                            </p>
                        </div>

                        <div class="pt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pastikan bukti pembayaran valid sebelum mengubah status ke "Sudah Dibayar"
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-200" style="color: #072138;">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Bukti Pembayaran
                    </h3>
                    
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Belum ada bukti pembayaran</p>
                        <p class="text-xs text-gray-400 mt-1">Customer belum mengupload bukti transfer</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>