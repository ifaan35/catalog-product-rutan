<x-app-layout>
    <div class="py-8 px-4 mx-auto max-w-6xl">
        <h1 class="text-2xl font-bold mb-6" style="color: #072138;">Checkout</h1>
        
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- KOLOM KIRI: Form Checkout --}}
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h2 class="text-xl font-bold border-b pb-3 mb-4" style="color: #072138; border-color: #DFE1E3;">Informasi Pengiriman</h2>
                    
                    {{-- Nama Lengkap --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Nama Lengkap *</label>
                        <input type="text" name="customer_name" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Email *</label>
                        <input type="email" name="customer_email" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="contoh@email.com">
                    </div>

                    {{-- No. Telepon --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">No. Telepon *</label>
                        <input type="tel" name="customer_phone" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="08xxxxxxxxxx">
                    </div>

                    {{-- Alamat Lengkap --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Alamat Lengkap *</label>
                        <textarea name="address" rows="3" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Nama Jalan, No Rumah, Kelurahan, Kecamatan..."></textarea>
                    </div>

                    {{-- Pemilihan Wilayah --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Alamat Pengiriman *</label>
                        
                        {{-- Province Dropdown --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Provinsi</label>
                            <select name="province_id" id="province-dropdown" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @php
                                    $provinces = \App\Models\Province::where('country_id', 1)->orderBy('name')->get();
                                @endphp
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- City Dropdown --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Kota</label>
                            <select name="city_id" id="city-dropdown" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" disabled required>
                                <option value="">-- Pilih Kota --</option>
                            </select>
                        </div>

                        {{-- Postal Code Display --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Kode Pos</label>
                            <input type="text" name="postal_code" id="postal-code" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" readonly placeholder="Otomatis terisi setelah pilih kota" required>
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

                    {{-- Total Perhitungan --}}
                    <div class="border-t pt-3" style="border-color: #DFE1E3;">
                        <div class="flex justify-between text-sm mb-2">
                            <span style="color: #072138;">Subtotal</span>
                            <span style="color: #072138;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-2">
                            <span style="color: #072138;">Ongkos Kirim</span>
                            <span style="color: #072138;">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg border-t pt-2" style="color: #072138; border-color: #DFE1E3;">
                            <span>Total</span>
                            <span style="color: #F3C32A;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Tombol Checkout --}}
                    <button type="submit" class="w-full mt-6 px-6 py-3 text-white font-semibold rounded-lg transition duration-200 hover:opacity-90" style="background-color: #072138;">
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- JavaScript untuk Dynamic Address Dropdown --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX untuk Province -> City Dropdown
            $('#province-dropdown').on('change', function() {
                var provinceId = $(this).val();
                
                // Reset dropdown kota dan kode pos
                $('#city-dropdown').html('<option value="">Memuat...</option>').prop('disabled', true);
                $('#postal-code').val('');
                
                if (provinceId) {
                    $.ajax({
                        url: '/api/cities/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#city-dropdown').html('<option value="">-- Pilih Kota --</option>');
                            $.each(data, function(key, city) {
                                $('#city-dropdown').append('<option value="' + city.id + '" data-postal="' + city.postal_code + '">' + city.name + '</option>');
                            });
                            $('#city-dropdown').prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching cities:", error);
                            $('#city-dropdown').html('<option value="">Gagal memuat kota</option>');
                        }
                    });
                } else {
                    $('#city-dropdown').html('<option value="">-- Pilih Kota --</option>').prop('disabled', true);
                }
            });
            
            // Handle City Selection dan Postal Code
            $('#city-dropdown').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var postalCode = selectedOption.data('postal');
                
                if (postalCode) {
                    $('#postal-code').val(postalCode);
                } else {
                    $('#postal-code').val('');
                }
            });
        });
    </script>
</x-app-layout>