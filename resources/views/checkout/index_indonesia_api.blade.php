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
                        <textarea name="address" rows="3" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Nama Jalan, No Rumah, RT/RW..."></textarea>
                    </div>

                    {{-- Pemilihan Wilayah Indonesia --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #072138;">Alamat Wilayah *</label>
                        
                        {{-- Province Dropdown --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Provinsi</label>
                            <select name="province_id" id="province-dropdown" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" required>
                                <option value="">Memuat provinsi...</option>
                            </select>
                        </div>

                        {{-- Regency/City Dropdown --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Kabupaten/Kota</label>
                            <select name="regency_id" id="regency-dropdown" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" disabled required>
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                            </select>
                        </div>

                        {{-- District Dropdown --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Kecamatan</label>
                            <select name="district_id" id="district-dropdown" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" disabled required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>

                        {{-- Village Dropdown --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Kelurahan/Desa</label>
                            <select name="village_id" id="village-dropdown" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" disabled required>
                                <option value="">-- Pilih Kelurahan/Desa --</option>
                            </select>
                        </div>

                        {{-- Postal Code Input --}}
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium" style="color: #072138;">Kode Pos</label>
                            <input type="text" name="postal_code" id="postal-code" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #DFE1E3; focus:ring-color: #F3C32A;" placeholder="Masukkan kode pos" required>
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

    {{-- JavaScript untuk Dynamic Indonesian Address Dropdown --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            
            // Load provinces on page load
            loadProvinces();
            
            function loadProvinces() {
                $.ajax({
                    url: '/api/indonesia/provinces',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#province-dropdown').html('<option value="">Memuat provinsi...</option>');
                    },
                    success: function(data) {
                        $('#province-dropdown').html('<option value="">-- Pilih Provinsi --</option>');
                        $.each(data, function(key, province) {
                            $('#province-dropdown').append('<option value="' + province.id + '">' + province.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading provinces:", error);
                        $('#province-dropdown').html('<option value="">Gagal memuat provinsi</option>');
                    }
                });
            }
            
            // Province change handler
            $('#province-dropdown').on('change', function() {
                var provinceId = $(this).val();
                
                // Reset subsequent dropdowns
                resetDropdowns(['regency', 'district', 'village']);
                
                if (provinceId) {
                    loadRegencies(provinceId);
                }
            });
            
            function loadRegencies(provinceId) {
                $.ajax({
                    url: '/api/indonesia/regencies/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#regency-dropdown').html('<option value="">Memuat kab/kota...</option>').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#regency-dropdown').html('<option value="">-- Pilih Kabupaten/Kota --</option>');
                        $.each(data, function(key, regency) {
                            $('#regency-dropdown').append('<option value="' + regency.id + '">' + regency.name + '</option>');
                        });
                        $('#regency-dropdown').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading regencies:", error);
                        $('#regency-dropdown').html('<option value="">Gagal memuat kab/kota</option>').prop('disabled', false);
                    }
                });
            }
            
            // Regency change handler
            $('#regency-dropdown').on('change', function() {
                var regencyId = $(this).val();
                
                // Reset subsequent dropdowns
                resetDropdowns(['district', 'village']);
                
                if (regencyId) {
                    loadDistricts(regencyId);
                }
            });
            
            function loadDistricts(regencyId) {
                $.ajax({
                    url: '/api/indonesia/districts/' + regencyId,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#district-dropdown').html('<option value="">Memuat kecamatan...</option>').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#district-dropdown').html('<option value="">-- Pilih Kecamatan --</option>');
                        $.each(data, function(key, district) {
                            $('#district-dropdown').append('<option value="' + district.id + '">' + district.name + '</option>');
                        });
                        $('#district-dropdown').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading districts:", error);
                        $('#district-dropdown').html('<option value="">Gagal memuat kecamatan</option>').prop('disabled', false);
                    }
                });
            }
            
            // District change handler
            $('#district-dropdown').on('change', function() {
                var districtId = $(this).val();
                
                // Reset subsequent dropdowns
                resetDropdowns(['village']);
                
                if (districtId) {
                    loadVillages(districtId);
                }
            });
            
            function loadVillages(districtId) {
                $.ajax({
                    url: '/api/indonesia/villages/' + districtId,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#village-dropdown').html('<option value="">Memuat kelurahan/desa...</option>').prop('disabled', true);
                    },
                    success: function(data) {
                        $('#village-dropdown').html('<option value="">-- Pilih Kelurahan/Desa --</option>');
                        $.each(data, function(key, village) {
                            $('#village-dropdown').append('<option value="' + village.id + '">' + village.name + '</option>');
                        });
                        $('#village-dropdown').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading villages:", error);
                        $('#village-dropdown').html('<option value="">Gagal memuat kelurahan/desa</option>').prop('disabled', false);
                    }
                });
            }
            
            function resetDropdowns(types) {
                types.forEach(function(type) {
                    $('#' + type + '-dropdown')
                        .html('<option value="">-- Pilih ' + getDropdownLabel(type) + ' --</option>')
                        .prop('disabled', true);
                });
            }
            
            function getDropdownLabel(type) {
                switch(type) {
                    case 'regency': return 'Kabupaten/Kota';
                    case 'district': return 'Kecamatan';
                    case 'village': return 'Kelurahan/Desa';
                    default: return '';
                }
            }
        });
    </script>
</x-app-layout>