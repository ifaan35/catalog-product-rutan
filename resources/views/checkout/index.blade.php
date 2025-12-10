{{-- resources/views/checkout/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" style="background-color: #F5F6F8;">
        <h1 class="text-3xl font-bold mb-8" style="color: #07213C;">Checkout & Pengiriman</h1>

        {{-- Error Messages Display --}}
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg border-l-4 border-red-500" style="background-color: #FEE2E2; color: #991B1B;">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="font-bold mb-2">Validasi Gagal!</h3>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: Formulir Alamat --}}
                <div class="lg:col-span-2 card p-6 rounded-lg">
                    <h2 class="text-xl font-semibold mb-6" style="color: #07213C;">Alamat Pengiriman</h2>
                    
                    {{-- Nama Penerima --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Nama Penerima</label>
                        <input type="text" name="recipient_name" value="{{ Auth::user()->name }}" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #E1E2E4; focus-ring-color: #ECBF62; color: #07213C;">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone_number" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #E1E2E4; focus-ring-color: #ECBF62; color: #07213C;" placeholder="Contoh: 08123456789">
                    </div>

                    {{-- Provinsi --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Provinsi *</label>
                        <div class="relative">
                            <select name="province_id" id="province_id" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;">
                                <option value="">-- Pilih Provinsi --</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2" style="color: #07213C;">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <div id="province_loading" class="text-xs mt-1" style="color: #6B7280; display: none;">Memuat...</div>
                    </div>

                    {{-- Kabupaten/Kota --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Kabupaten / Kota *</label>
                        <div class="relative">
                            <select name="regency_id" id="regency_id" required disabled class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2" style="color: #07213C;">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <div id="regency_loading" class="text-xs mt-1" style="color: #6B7280; display: none;">Memuat...</div>
                    </div>

                    {{-- Kecamatan --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Kecamatan *</label>
                        <div class="relative">
                            <select name="district_id" id="district_id" required disabled class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;">
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2" style="color: #07213C;">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <div id="district_loading" class="text-xs mt-1" style="color: #6B7280; display: none;">Memuat...</div>
                    </div>

                    {{-- Kelurahan/Desa --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Kelurahan / Desa *</label>
                        <div class="relative">
                            <select name="village_id" id="village_id" required disabled class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;">
                                <option value="">-- Pilih Kelurahan/Desa --</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2" style="color: #07213C;">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <div id="village_loading" class="text-xs mt-1" style="color: #6B7280; display: none;">Memuat...</div>
                    </div>

                    {{-- Alamat Detail --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Detail Alamat (No. Rumah, Nama Jalan, etc.) *</label>
                        <textarea name="detail_address" id="detail_address" rows="3" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #E1E2E4; color: #07213C;" placeholder="Contoh: Jl. Merdeka No. 123, RT 05 RW 03"></textarea>
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Catatan untuk Kurir (Opsional)</label>
                        <textarea name="notes" rows="2" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #E1E2E4; color: #07213C;" placeholder="Contoh: Rumah cat biru, sebelah toko kelontong..."></textarea>
                    </div>
                </div>

                {{-- KOLOM KANAN: Ringkasan Pesanan --}}
                <div class="card p-6 rounded-lg h-fit">
                    <h2 class="text-xl font-bold border-b pb-3 mb-4" style="color: #07213C; border-color: #E1E2E4;">Ringkasan Pesanan</h2>
                    
                    {{-- List Item Ringkas --}}
                    <div class="space-y-3 mb-4 max-h-60 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <div class="flex-1">
                                    <span style="color: #07213C;">{{ $item['name'] }}</span>
                                    <div class="text-xs" style="color: #6B7280;">
                                        Qty: {{ $item['quantity'] }}
                                    </div>
                                </div>
                                <span class="font-semibold ml-2" style="color: #ECBF62;">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4" style="border-color: #E1E2E4;">
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm" style="color: #6B7280;">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm" style="color: #6B7280;">
                                <span>Ongkos Kirim:</span>
                                <span>Gratis</span>
                            </div>
                            <div class="flex justify-between text-sm" style="color: #6B7280;">
                                <span>Biaya Admin:</span>
                                <span>Rp 0</span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between font-bold text-xl mb-6" style="color: #07213C;">
                            <span>Total Bayar:</span>
                            <span style="color: #ECBF62;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        {{-- Input Hidden untuk Total --}}
                        <input type="hidden" name="total_amount" value="{{ $total }}">

                        {{-- Hidden fields untuk nama yang dipilih --}}
                        <input type="hidden" name="province_name" id="province_name">
                        <input type="hidden" name="regency_name" id="regency_name">
                        <input type="hidden" name="district_name" id="district_name">
                        <input type="hidden" name="village_name" id="village_name">

                        <button type="submit" class="w-full font-bold py-3 rounded-lg transition duration-300 hover:opacity-90 shadow-lg" style="background-color: #ECBF62; color: #07213C;">
                            🔒 KONFIRMASI PEMBAYARAN
                        </button>
                        <p class="text-xs text-center mt-2" style="color: #6B7280;">Data Anda diamankan dengan enkripsi SSL.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const API_BASE = '/api/indonesia';

        // Load provinces on page load
        document.addEventListener('DOMContentLoaded', async () => {
            console.log('DOMContentLoaded - Loading provinces...');
            await loadProvinces();
        });

        // Load provinces
        async function loadProvinces() {
            try {
                console.log('Starting to load provinces from:', API_BASE + '/provinces');
                document.getElementById('province_loading').style.display = 'inline';
                document.getElementById('province_loading').textContent = 'Memuat data provinsi...';
                
                const response = await fetch(`${API_BASE}/provinces`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Provinces loaded:', data.length, 'items');
                
                const select = document.getElementById('province_id');
                select.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    select.appendChild(option);
                });
                
                document.getElementById('province_loading').style.display = 'none';
                console.log('Provinces loaded successfully!');
            } catch (error) {
                console.error('Error loading provinces:', error);
                document.getElementById('province_loading').style.display = 'inline';
                document.getElementById('province_loading').textContent = '❌ Gagal memuat. Klik untuk mencoba lagi.';
                document.getElementById('province_loading').style.cursor = 'pointer';
                document.getElementById('province_loading').style.color = '#EF4444';
                document.getElementById('province_loading').onclick = loadProvinces;
            }
        }

        // On province change
        document.getElementById('province_id').addEventListener('change', async (e) => {
            const provinceId = e.target.value;
            const provinceName = e.target.options[e.target.selectedIndex].text;
            
            // Reset dependent selects
            document.getElementById('regency_id').innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
            document.getElementById('district_id').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            document.getElementById('village_id').innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
            
            if (!provinceId) {
                document.getElementById('regency_id').disabled = true;
                document.getElementById('district_id').disabled = true;
                document.getElementById('village_id').disabled = true;
                document.getElementById('province_name').value = '';
                return;
            }

            document.getElementById('province_name').value = provinceName;
            await loadRegencies(provinceId);
        });

        // Load regencies
        async function loadRegencies(provinceId) {
            try {
                document.getElementById('regency_loading').style.display = 'inline';
                const response = await fetch(`${API_BASE}/regencies/${provinceId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                const select = document.getElementById('regency_id');
                select.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                select.disabled = false;
                
                data.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.id;
                    option.textContent = regency.name;
                    select.appendChild(option);
                });
                
                document.getElementById('regency_loading').style.display = 'none';
            } catch (error) {
                console.error('Error loading regencies:', error);
                document.getElementById('regency_loading').style.display = 'none';
            }
        }

        // On regency change
        document.getElementById('regency_id').addEventListener('change', async (e) => {
            const regencyId = e.target.value;
            const regencyName = e.target.options[e.target.selectedIndex].text;
            
            // Reset dependent selects
            document.getElementById('district_id').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            document.getElementById('village_id').innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
            
            if (!regencyId) {
                document.getElementById('district_id').disabled = true;
                document.getElementById('village_id').disabled = true;
                document.getElementById('regency_name').value = '';
                return;
            }

            document.getElementById('regency_name').value = regencyName;
            await loadDistricts(regencyId);
        });

        // Load districts
        async function loadDistricts(regencyId) {
            try {
                document.getElementById('district_loading').style.display = 'inline';
                const response = await fetch(`${API_BASE}/districts/${regencyId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                const select = document.getElementById('district_id');
                select.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                select.disabled = false;
                
                data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name;
                    select.appendChild(option);
                });
                
                document.getElementById('district_loading').style.display = 'none';
            } catch (error) {
                console.error('Error loading districts:', error);
                document.getElementById('district_loading').style.display = 'none';
            }
        }

        // On district change
        document.getElementById('district_id').addEventListener('change', async (e) => {
            const districtId = e.target.value;
            const districtName = e.target.options[e.target.selectedIndex].text;
            
            // Reset village select
            document.getElementById('village_id').innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
            
            if (!districtId) {
                document.getElementById('village_id').disabled = true;
                document.getElementById('district_name').value = '';
                return;
            }

            document.getElementById('district_name').value = districtName;
            await loadVillages(districtId);
        });

        // Load villages
        async function loadVillages(districtId) {
            try {
                document.getElementById('village_loading').style.display = 'inline';
                const response = await fetch(`${API_BASE}/villages/${districtId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                const select = document.getElementById('village_id');
                select.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                select.disabled = false;
                
                data.forEach(village => {
                    const option = document.createElement('option');
                    option.value = village.id;
                    option.textContent = village.name;
                    select.appendChild(option);
                });
                
                document.getElementById('village_loading').style.display = 'none';
            } catch (error) {
                console.error('Error loading villages:', error);
                document.getElementById('village_loading').style.display = 'none';
            }
        }

        // On village change
        document.getElementById('village_id').addEventListener('change', (e) => {
            const villageName = e.target.options[e.target.selectedIndex].text;
            document.getElementById('village_name').value = villageName;
        });
    </script>
</x-app-layout>