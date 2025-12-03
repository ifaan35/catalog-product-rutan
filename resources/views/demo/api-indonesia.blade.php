<x-app-layout>
    <div class="py-8 px-4 mx-auto max-w-6xl">
        <h1 class="text-3xl font-bold mb-6" style="color: #072138;">Demo API Wilayah Indonesia</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-xl mb-6">
            <h2 class="text-xl font-bold mb-4" style="color: #072138;">Available API Endpoints</h2>
            <div class="space-y-2 text-sm">
                <div><strong>GET</strong> <code>/api/indonesia/provinces</code> - Mengambil semua provinsi</div>
                <div><strong>GET</strong> <code>/api/indonesia/regencies/{provinceId}</code> - Mengambil kab/kota berdasarkan provinsi</div>
                <div><strong>GET</strong> <code>/api/indonesia/districts/{regencyId}</code> - Mengambil kecamatan berdasarkan kab/kota</div>
                <div><strong>GET</strong> <code>/api/indonesia/villages/{districtId}</code> - Mengambil kelurahan/desa berdasarkan kecamatan</div>
                <div><strong>GET</strong> <code>/api/indonesia/province/{provinceId}</code> - Mengambil data provinsi berdasarkan ID</div>
                <div><strong>GET</strong> <code>/api/indonesia/regency/{regencyId}</code> - Mengambil data kab/kota berdasarkan ID</div>
                <div><strong>GET</strong> <code>/api/indonesia/district/{districtId}</code> - Mengambil data kecamatan berdasarkan ID</div>
                <div><strong>GET</strong> <code>/api/indonesia/village/{villageId}</code> - Mengambil data kelurahan/desa berdasarkan ID</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- API Testing Panel --}}
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-xl font-bold mb-4" style="color: #072138;">Test API Endpoints</h2>
                
                <div class="space-y-4">
                    {{-- Test Provinces --}}
                    <div>
                        <button id="btn-provinces" class="px-4 py-2 text-white rounded" style="background-color: #072138;">
                            Load Provinces
                        </button>
                    </div>
                    
                    {{-- Test Regencies --}}
                    <div>
                        <input type="text" id="province-id" placeholder="Province ID (e.g., 11)" class="border rounded px-3 py-2 mr-2" style="border-color: #DFE1E3;">
                        <button id="btn-regencies" class="px-4 py-2 text-white rounded" style="background-color: #072138;">
                            Load Regencies
                        </button>
                    </div>
                    
                    {{-- Test Districts --}}
                    <div>
                        <input type="text" id="regency-id" placeholder="Regency ID (e.g., 1103)" class="border rounded px-3 py-2 mr-2" style="border-color: #DFE1E3;">
                        <button id="btn-districts" class="px-4 py-2 text-white rounded" style="background-color: #072138;">
                            Load Districts
                        </button>
                    </div>
                    
                    {{-- Test Villages --}}
                    <div>
                        <input type="text" id="district-id" placeholder="District ID (e.g., 1103010)" class="border rounded px-3 py-2 mr-2" style="border-color: #DFE1E3;">
                        <button id="btn-villages" class="px-4 py-2 text-white rounded" style="background-color: #072138;">
                            Load Villages
                        </button>
                    </div>
                    
                    {{-- Test Single Data --}}
                    <div class="pt-4 border-t" style="border-color: #DFE1E3;">
                        <h3 class="font-medium mb-2" style="color: #072138;">Single Data Endpoints:</h3>
                        <div class="space-y-2">
                            <div>
                                <input type="text" id="single-province-id" placeholder="Province ID" class="border rounded px-3 py-2 mr-2" style="border-color: #DFE1E3;">
                                <button id="btn-single-province" class="px-3 py-2 text-white rounded text-sm" style="background-color: #F3C32A; color: #072138;">Get Province</button>
                            </div>
                            <div>
                                <input type="text" id="single-regency-id" placeholder="Regency ID" class="border rounded px-3 py-2 mr-2" style="border-color: #DFE1E3;">
                                <button id="btn-single-regency" class="px-3 py-2 text-white rounded text-sm" style="background-color: #F3C32A; color: #072138;">Get Regency</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Results Panel --}}
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-xl font-bold mb-4" style="color: #072138;">API Response</h2>
                <div id="api-result" class="bg-gray-50 p-4 rounded border min-h-96 max-h-96 overflow-y-auto">
                    <div class="text-gray-500 text-center">Click any button to test API endpoints</div>
                </div>
            </div>
        </div>

        {{-- Full Address Demo --}}
        <div class="bg-white p-6 rounded-lg shadow-xl mt-6">
            <h2 class="text-xl font-bold mb-4" style="color: #072138;">Full Address Dropdown Demo</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block mb-1 font-medium text-sm" style="color: #072138;">Provinsi</label>
                    <select id="demo-province" class="w-full border rounded px-3 py-2" style="border-color: #DFE1E3;">
                        <option value="">Loading...</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-sm" style="color: #072138;">Kabupaten/Kota</label>
                    <select id="demo-regency" class="w-full border rounded px-3 py-2" style="border-color: #DFE1E3;" disabled>
                        <option value="">-- Pilih Kab/Kota --</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-sm" style="color: #072138;">Kecamatan</label>
                    <select id="demo-district" class="w-full border rounded px-3 py-2" style="border-color: #DFE1E3;" disabled>
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-sm" style="color: #072138;">Kelurahan/Desa</label>
                    <select id="demo-village" class="w-full border rounded px-3 py-2" style="border-color: #DFE1E3;" disabled>
                        <option value="">-- Pilih Kelurahan --</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 bg-gray-50 rounded">
                <strong>Selected Address:</strong> <span id="selected-address">None</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            
            // API Testing Functions
            $('#btn-provinces').click(function() {
                testAPI('/api/indonesia/provinces', 'Provinces');
            });
            
            $('#btn-regencies').click(function() {
                const provinceId = $('#province-id').val();
                if (!provinceId) {
                    alert('Please enter Province ID');
                    return;
                }
                testAPI('/api/indonesia/regencies/' + provinceId, 'Regencies');
            });
            
            $('#btn-districts').click(function() {
                const regencyId = $('#regency-id').val();
                if (!regencyId) {
                    alert('Please enter Regency ID');
                    return;
                }
                testAPI('/api/indonesia/districts/' + regencyId, 'Districts');
            });
            
            $('#btn-villages').click(function() {
                const districtId = $('#district-id').val();
                if (!districtId) {
                    alert('Please enter District ID');
                    return;
                }
                testAPI('/api/indonesia/villages/' + districtId, 'Villages');
            });
            
            $('#btn-single-province').click(function() {
                const provinceId = $('#single-province-id').val();
                if (!provinceId) {
                    alert('Please enter Province ID');
                    return;
                }
                testAPI('/api/indonesia/province/' + provinceId, 'Single Province');
            });
            
            $('#btn-single-regency').click(function() {
                const regencyId = $('#single-regency-id').val();
                if (!regencyId) {
                    alert('Please enter Regency ID');
                    return;
                }
                testAPI('/api/indonesia/regency/' + regencyId, 'Single Regency');
            });
            
            function testAPI(url, title) {
                $('#api-result').html('<div class="text-blue-600">Loading ' + title + '...</div>');
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const formattedJSON = JSON.stringify(data, null, 2);
                        $('#api-result').html('<strong>' + title + ' Response:</strong><br><pre class="mt-2 text-xs">' + formattedJSON + '</pre>');
                    },
                    error: function(xhr, status, error) {
                        $('#api-result').html('<div class="text-red-600"><strong>Error:</strong> ' + error + '<br><strong>Status:</strong> ' + xhr.status + '</div>');
                    }
                });
            }
            
            // Full Address Demo
            loadDemoProvinces();
            
            function loadDemoProvinces() {
                $.ajax({
                    url: '/api/indonesia/provinces',
                    type: 'GET',
                    success: function(data) {
                        $('#demo-province').html('<option value="">-- Pilih Provinsi --</option>');
                        $.each(data, function(key, province) {
                            $('#demo-province').append('<option value="' + province.id + '">' + province.name + '</option>');
                        });
                    }
                });
            }
            
            $('#demo-province').change(function() {
                const provinceId = $(this).val();
                resetDemoDropdowns(['regency', 'district', 'village']);
                updateSelectedAddress();
                
                if (provinceId) {
                    loadDemoRegencies(provinceId);
                }
            });
            
            function loadDemoRegencies(provinceId) {
                $.ajax({
                    url: '/api/indonesia/regencies/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        $('#demo-regency').html('<option value="">-- Pilih Kab/Kota --</option>');
                        $.each(data, function(key, regency) {
                            $('#demo-regency').append('<option value="' + regency.id + '">' + regency.name + '</option>');
                        });
                        $('#demo-regency').prop('disabled', false);
                    }
                });
            }
            
            $('#demo-regency').change(function() {
                const regencyId = $(this).val();
                resetDemoDropdowns(['district', 'village']);
                updateSelectedAddress();
                
                if (regencyId) {
                    loadDemoDistricts(regencyId);
                }
            });
            
            function loadDemoDistricts(regencyId) {
                $.ajax({
                    url: '/api/indonesia/districts/' + regencyId,
                    type: 'GET',
                    success: function(data) {
                        $('#demo-district').html('<option value="">-- Pilih Kecamatan --</option>');
                        $.each(data, function(key, district) {
                            $('#demo-district').append('<option value="' + district.id + '">' + district.name + '</option>');
                        });
                        $('#demo-district').prop('disabled', false);
                    }
                });
            }
            
            $('#demo-district').change(function() {
                const districtId = $(this).val();
                resetDemoDropdowns(['village']);
                updateSelectedAddress();
                
                if (districtId) {
                    loadDemoVillages(districtId);
                }
            });
            
            function loadDemoVillages(districtId) {
                $.ajax({
                    url: '/api/indonesia/villages/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        $('#demo-village').html('<option value="">-- Pilih Kelurahan/Desa --</option>');
                        $.each(data, function(key, village) {
                            $('#demo-village').append('<option value="' + village.id + '">' + village.name + '</option>');
                        });
                        $('#demo-village').prop('disabled', false);
                    }
                });
            }
            
            $('#demo-village').change(function() {
                updateSelectedAddress();
            });
            
            function resetDemoDropdowns(types) {
                types.forEach(function(type) {
                    $('#demo-' + type).html('<option value="">-- Pilih ' + getDemoLabel(type) + ' --</option>').prop('disabled', true);
                });
            }
            
            function getDemoLabel(type) {
                switch(type) {
                    case 'regency': return 'Kab/Kota';
                    case 'district': return 'Kecamatan';
                    case 'village': return 'Kelurahan/Desa';
                    default: return '';
                }
            }
            
            function updateSelectedAddress() {
                const province = $('#demo-province option:selected').text();
                const regency = $('#demo-regency option:selected').text();
                const district = $('#demo-district option:selected').text();
                const village = $('#demo-village option:selected').text();
                
                let address = [];
                if (village && village !== '-- Pilih Kelurahan/Desa --') address.push(village);
                if (district && district !== '-- Pilih Kecamatan --') address.push(district);
                if (regency && regency !== '-- Pilih Kab/Kota --') address.push(regency);
                if (province && province !== '-- Pilih Provinsi --') address.push(province);
                
                $('#selected-address').text(address.length > 0 ? address.join(', ') : 'None');
            }
        });
    </script>
</x-app-layout>