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

        <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
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
                            <select name="regency_id" id="regency_id" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;" data-disabled="true">
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
                            <select name="district_id" id="district_id" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;" data-disabled="true">
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
                            <select name="village_id" id="village_id" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 appearance-none" style="border-color: #E1E2E4; color: #07213C;" data-disabled="true">
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

                    {{-- Kode Pos --}}
                    <div class="mb-4">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Kode Pos *</label>
                        <input type="text" name="postal_code" id="postal_code" required maxlength="10" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #E1E2E4; color: #07213C;" placeholder="Contoh: 12345">
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

                        <button type="button" id="submit-btn" class="w-full font-bold py-3 rounded-lg transition duration-300 hover:opacity-90 shadow-lg" style="background-color: #ECBF62; color: #07213C;">
                            🔒 KONFIRMASI PEMBAYARAN
                        </button>
                        <p class="text-xs text-center mt-2" style="color: #6B7280;">Data Anda diamankan dengan enkripsi SSL.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Midtrans Snap.js - Load with explicit onload callback -->
    <script type="text/javascript"
            src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('midtrans.client_key') }}"
            onload="console.log('✓ Midtrans Snap.js loaded successfully'); window.snapLoaded = true;"
            onerror="console.error('✗ Failed to load Midtrans Snap.js'); window.snapLoaded = false;"></script>

    <script>
        const API_BASE = '/api/indonesia';
        
        // Debug: Log Midtrans configuration
        console.log('%c=== MIDTRANS CONFIGURATION ===', 'color: blue; font-weight: bold;');
        console.log('Client Key:', '{{ config("midtrans.client_key") }}');
        console.log('Is Production:', {{ config('midtrans.is_production') ? 'true' : 'false' }});
        console.log('Snap URL:', '{{ config("midtrans.is_production") ? "https://app.midtrans.com/snap/snap.js" : "https://app.sandbox.midtrans.com/snap/snap.js" }}');

        // Load provinces on page load
        document.addEventListener('DOMContentLoaded', async () => {
            console.log('DOMContentLoaded - Loading provinces...');
            
            // Wait for Snap.js to load
            let attempts = 0;
            while (typeof window.snap === 'undefined' && attempts < 50) {
                await new Promise(resolve => setTimeout(resolve, 100));
                attempts++;
            }
            
            if (typeof window.snap !== 'undefined') {
                console.log('%c✓ Midtrans Snap is ready!', 'color: green; font-weight: bold;');
            } else {
                console.error('%c✗ Midtrans Snap failed to load after 5 seconds!', 'color: red; font-weight: bold;');
            }
            
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
                document.getElementById('regency_id').setAttribute('data-disabled', 'true');
                document.getElementById('regency_id').style.opacity = '0.5';
                document.getElementById('district_id').setAttribute('data-disabled', 'true');
                document.getElementById('district_id').style.opacity = '0.5';
                document.getElementById('village_id').setAttribute('data-disabled', 'true');
                document.getElementById('village_id').style.opacity = '0.5';
                document.getElementById('province_name').value = '';
                return;
            }

            document.getElementById('province_name').value = provinceName;
            console.log('✓ Province selected:', { id: provinceId, name: provinceName });
            document.getElementById('regency_id').removeAttribute('data-disabled');
            document.getElementById('regency_id').style.opacity = '1';
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
                select.removeAttribute('data-disabled');
                select.style.opacity = '1';
                
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
                document.getElementById('district_id').setAttribute('data-disabled', 'true');
                document.getElementById('district_id').style.opacity = '0.5';
                document.getElementById('village_id').setAttribute('data-disabled', 'true');
                document.getElementById('village_id').style.opacity = '0.5';
                document.getElementById('regency_name').value = '';
                return;
            }

            document.getElementById('regency_name').value = regencyName;
            console.log('✓ Regency selected:', { id: regencyId, name: regencyName });
            document.getElementById('district_id').removeAttribute('data-disabled');
            document.getElementById('district_id').style.opacity = '1';
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
                select.removeAttribute('data-disabled');
                select.style.opacity = '1';
                
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
                document.getElementById('village_id').setAttribute('data-disabled', 'true');
                document.getElementById('village_id').style.opacity = '0.5';
                document.getElementById('district_name').value = '';
                return;
            }

            document.getElementById('district_name').value = districtName;
            console.log('✓ District selected:', { id: districtId, name: districtName });
            document.getElementById('village_id').removeAttribute('data-disabled');
            document.getElementById('village_id').style.opacity = '1';
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
                select.removeAttribute('data-disabled');
                select.style.opacity = '1';
                
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
            console.log('✓ Village selected:', { id: e.target.value, name: villageName });
        });

        // Button click handler - MAIN PAYMENT HANDLER
        const submitBtn = document.getElementById('submit-btn');
        const form = document.getElementById('checkout-form');
        
        console.log('%c=== FORM DEBUGGING ===', 'color: purple; font-weight: bold;');
        console.log('Submit button found:', submitBtn !== null);
        console.log('Form found:', form !== null);
        console.log('Form element:', form);
        
        if (submitBtn && form) {
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent any default action
                
                console.log('%c=== CHECKOUT PAYMENT PROCESS START ===', 'color: blue; font-weight: bold; font-size: 14px;');
                console.log('Button clicked!', this);
                console.log('Form:', form);
                console.log('Form Action:', form.action);
            
                // Extract all required fields
                const formData = new FormData(form);
            
            console.log('%cAll Form Fields:', 'color: purple; font-weight: bold;');
            for (let [key, value] of formData.entries()) {
                console.log(`  ${key}: "${value}"`);
            }
            
            // Get individual field values for validation (with safe null checking)
            const recipient_name = form.querySelector('input[name="recipient_name"]')?.value?.trim() || '';
            const phone_number = form.querySelector('input[name="phone_number"]')?.value?.trim() || '';
            const province_id = form.querySelector('select[name="province_id"]')?.value?.trim() || '';
            const regency_id = form.querySelector('select[name="regency_id"]')?.value?.trim() || '';
            const district_id = form.querySelector('select[name="district_id"]')?.value?.trim() || '';
            const village_id = form.querySelector('select[name="village_id"]')?.value?.trim() || '';
            const detail_address = form.querySelector('textarea[name="detail_address"]')?.value?.trim() || '';
            const postal_code = form.querySelector('input[name="postal_code"]')?.value?.trim() || '';
            const province_name = form.querySelector('input[name="province_name"]')?.value?.trim() || '';
            const regency_name = form.querySelector('input[name="regency_name"]')?.value?.trim() || '';
            const district_name = form.querySelector('input[name="district_name"]')?.value?.trim() || '';
            const village_name = form.querySelector('input[name="village_name"]')?.value?.trim() || '';

            console.log('%cExtracted Form Data:', 'color: orange; font-weight: bold;', {
                recipient_name: { value: recipient_name, length: recipient_name.length },
                phone_number: { value: phone_number, length: phone_number.length },
                province_id: { value: province_id, length: province_id.length },
                province_name: { value: province_name, length: province_name.length },
                regency_id: { value: regency_id, length: regency_id.length },
                regency_name: { value: regency_name, length: regency_name.length },
                district_id: { value: district_id, length: district_id.length },
                district_name: { value: district_name, length: district_name.length },
                village_id: { value: village_id, length: village_id.length },
                village_name: { value: village_name, length: village_name.length },
                detail_address: { value: detail_address, length: detail_address.length },
                postal_code: { value: postal_code, length: postal_code.length }
            });

            // Perform validation
            let errors = [];
            if (!recipient_name) errors.push('❌ Nama Penerima harus diisi');
            if (!phone_number) errors.push('❌ Nomor Telepon harus diisi');
            if (!province_id) errors.push('❌ Provinsi harus dipilih');
            if (!province_name) errors.push('❌ Nama Provinsi tidak tersimpan (silahkan pilih ulang Provinsi)');
            if (!regency_id) errors.push('❌ Kabupaten/Kota harus dipilih');
            if (!regency_name) errors.push('❌ Nama Kabupaten/Kota tidak tersimpan (silahkan pilih ulang)');
            if (!district_id) errors.push('❌ Kecamatan harus dipilih');
            if (!district_name) errors.push('❌ Nama Kecamatan tidak tersimpan (silahkan pilih ulang)');
            if (!village_id) errors.push('❌ Kelurahan/Desa harus dipilih');
            if (!village_name) errors.push('❌ Nama Kelurahan/Desa tidak tersimpan (silahkan pilih ulang)');
            if (!detail_address) errors.push('❌ Detail Alamat harus diisi');
            if (!postal_code) errors.push('❌ Kode Pos harus diisi');

            console.log('%cValidation Result:', 'color: darkred; font-weight: bold;', `${errors.length === 0 ? '✓ PASSED' : '✗ FAILED'}`);

            if (errors.length > 0) {
                console.error('%cVALIDATION ERRORS:', 'color: red; font-weight: bold; font-size: 12px;', errors);
                const errorMsg = 'Validasi Form Gagal!\n\n' + errors.join('\n');
                console.error(errorMsg);
                alert(errorMsg);
                return false;
            }

            console.log('%c✓ ALL VALIDATION PASSED - PROCESSING PAYMENT', 'color: green; font-weight: bold; font-size: 14px;');
            
            // Submit form via AJAX to get Snap Token
            submitBtn.disabled = true;
            submitBtn.innerHTML = '⏳ Memproses...';
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value;
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('%cResponse data received:', 'color: blue; font-weight: bold;', data);
                
                if (data.success && data.snap_token) {
                    console.log('%c✓ Snap Token received:', 'color: green; font-weight: bold;', data.snap_token);
                    console.log('Order ID:', data.order_id);
                    
                    // Check if snap is loaded
                    console.log('Checking window.snap...', typeof window.snap);
                    
                    if (typeof window.snap === 'undefined') {
                        console.error('%c✗ window.snap is undefined!', 'color: red; font-weight: bold;');
                        throw new Error('Midtrans Snap belum loaded. Silakan refresh halaman.');
                    }
                    
                    console.log('%c✓ Opening Midtrans payment popup...', 'color: green; font-weight: bold;');
                    
                    // Open Midtrans Snap popup
                    try {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('%cPayment Success!', 'color: green; font-weight: bold;', result);
                                window.location.href = '/checkout/success/' + data.order_id;
                            },
                            onPending: function(result) {
                                console.log('%cPayment Pending', 'color: orange; font-weight: bold;', result);
                                window.location.href = '/checkout/success/' + data.order_id;
                            },
                            onError: function(result) {
                                console.error('%cPayment Error!', 'color: red; font-weight: bold;', result);
                                alert('Pembayaran gagal. Silakan coba lagi.');
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = '🔒 KONFIRMASI PEMBAYARAN';
                            },
                            onClose: function() {
                                console.log('%cPayment popup closed by user', 'color: gray; font-weight: bold;');
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = '🔒 KONFIRMASI PEMBAYARAN';
                            }
                        });
                    } catch (snapError) {
                        console.error('%c✗ Error calling window.snap.pay():', 'color: red; font-weight: bold;', snapError);
                        throw snapError;
                    }
                } else {
                    console.error('%c✗ Invalid response from server', 'color: red; font-weight: bold;', data);
                    throw new Error(data.message || 'Gagal membuat transaksi');
                }
            })
            .catch(error => {
                console.error('%c✗ CHECKOUT ERROR:', 'color: red; font-weight: bold; font-size: 14px;', error);
                console.error('Error details:', error.message);
                console.error('Error stack:', error.stack);
                alert('Terjadi kesalahan: ' + error.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '🔒 KONFIRMASI PEMBAYARAN';
            });
            });
        }
    </script>
</x-app-layout>