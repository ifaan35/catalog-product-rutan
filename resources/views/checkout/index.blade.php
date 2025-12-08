{{-- resources/views/checkout/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" style="background-color: #DFE1E3;">
        <h1 class="text-3xl font-bold mb-8" style="color: #072138;">Checkout & Pengiriman</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: Formulir Alamat --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-6" style="color: #072138;">Alamat Pengiriman</h2>
                    
                    {{-- Nama Penerima --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Nama Penerima</label>
                        <input type="text" name="recipient_name" value="{{ Auth::user()->name }}" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone_number" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Contoh: 08123456789">
                    </div>

                    {{-- Alamat Lengkap --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Alamat Lengkap</label>
                        <textarea name="address" rows="3" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Nama Jalan, No Rumah, Kelurahan, Kecamatan..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #072138;">Kota</label>
                            <input type="text" name="city" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Contoh: Jakarta">
                        </div>
                        <div>
                            <label class="block mb-2 font-medium" style="color: #072138;">Kode Pos</label>
                            <input type="text" name="postal_code" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Contoh: 12345">
                        </div>
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div class="mt-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Catatan untuk Kurir (Opsional)</label>
                        <textarea name="notes" rows="2" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Contoh: Rumah cat biru, sebelah toko kelontong..."></textarea>
                    </div>
                </div>

                {{-- KOLOM KANAN: Ringkasan Pesanan --}}
                <div class="bg-white p-6 rounded-lg shadow-xl h-fit">
                    <h2 class="text-xl font-bold border-b pb-3 mb-4" style="color: #072138; border-color: #DFE1E3;">Ringkasan Pesanan</h2>
                    
                    {{-- List Item Ringkas --}}
                    <div class="space-y-3 mb-4 max-h-60 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <div class="flex-1">
                                    <span style="color: #072138;">{{ $item['name'] }}</span>
                                    <div class="text-xs" style="color: #072138; opacity: 0.6;">
                                        Ukuran: {{ $item['size'] }} | Qty: {{ $item['quantity'] }}
                                    </div>
                                </div>
                                <span class="font-semibold ml-2" style="color: #F3C32A;">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4" style="border-color: #DFE1E3;">
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm" style="color: #072138; opacity: 0.7;">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm" style="color: #072138; opacity: 0.7;">
                                <span>Ongkos Kirim:</span>
                                <span>Gratis</span>
                            </div>
                            <div class="flex justify-between text-sm" style="color: #072138; opacity: 0.7;">
                                <span>Biaya Admin:</span>
                                <span>Rp 0</span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between font-bold text-xl mb-6" style="color: #072138;">
                            <span>Total Bayar:</span>
                            <span style="color: #F3C32A;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        {{-- Input Hidden untuk Total --}}
                        <input type="hidden" name="total_amount" value="{{ $total }}">

                        <button type="submit" class="w-full font-bold py-3 rounded-lg transition duration-300 hover:opacity-90 shadow-lg" style="background-color: #F3C32A; color: #072138;">
                            🔒 KONFIRMASI PEMBAYARAN
                        </button>
                        <p class="text-xs text-center mt-2" style="color: #072138; opacity: 0.6;">Data Anda diamankan dengan enkripsi SSL.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>