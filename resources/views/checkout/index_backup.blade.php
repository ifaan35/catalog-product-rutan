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
                                        Qty: {{ $item['quantity'] }}
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

    {{-- JavaScript untuk Dynamic Address Dropdown --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX untuk Province -> City Dropdown
            $('#province-dropdown').on('change', function() {
                var provinceId = $(this).val();
                
                // Reset dropdown kota dan kode pos
                $('#city-dropdown').html('<option value="">Memuat...</option>').prop('disabled', true);
                $('#postal-code').val('').prop('disabled', true);
                
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
                    'ACEH BESAR': {'LEMBAH SEULAWAH': ['23361', '23362'], 'MESJID RAYA': ['23363', '23364']},
                    'ACEH SELATAN': {'TAPAKTUAN': ['23711', '23712'], 'TRUMON': ['23713', '23714']},
                    'ACEH UTARA': {'LHOKSUKON': ['24381', '24382'], 'TANAH JAMBO AYE': ['24383', '24384']},
                    'BANDA ACEH': {'BAITURRAHMAN': ['23111', '23112'], 'KUTA ALAM': ['23113', '23114']},
                    'LANGSA': {'LANGSA KOTA': ['24411', '24412'], 'LANGSA LAMA': ['24413', '24414']}
                },
                'SUMATERA UTARA': {
                    'MEDAN': {'MEDAN KOTA': ['20111', '20112'], 'MEDAN BARAT': ['20113', '20114']},
                    'BINJAI': {'BINJAI KOTA': ['20711', '20712'], 'BINJAI UTARA': ['20713', '20714']},
                    'TEBING TINGGI': {'TEBING TINGGI KOTA': ['20631', '20632'], 'PADANG HULU': ['20633', '20634']},
                    'PEMATANGSIANTAR': {'SIANTAR TIMUR': ['21111', '21112'], 'SIANTAR BARAT': ['21113', '21114']},
                    'TANJUNGBALAI': {'TANJUNGBALAI SELATAN': ['21331', '21332'], 'TANJUNGBALAI UTARA': ['21333', '21334']}
                },
                'SUMATERA BARAT': {
                    'PADANG': {'PADANG TIMUR': ['25111', '25112'], 'PADANG BARAT': ['25113', '25114']},
                    'BUKITTINGGI': {'GUGUK PANJANG': ['26111', '26112'], 'MANDIANGIN KOTO SELAYAN': ['26113', '26114']},
                    'PAYAKUMBUH': {'PAYAKUMBUH BARAT': ['26211', '26212'], 'PAYAKUMBUH UTARA': ['26213', '26214']},
                    'PADANG PANJANG': {'PADANG PANJANG BARAT': ['27111', '27112'], 'PADANG PANJANG TIMUR': ['27113', '27114']},
                    'SOLOK': {'SOLOK KOTA': ['27311', '27312'], 'SOLOK SELATAN': ['27313', '27314']}
                },
                'RIAU': {
                    'PEKANBARU': {'SUKAJADI': ['28111', '28112'], 'SAIL': ['28113', '28114']},
                    'DUMAI': {'DUMAI KOTA': ['28811', '28812'], 'DUMAI BARAT': ['28813', '28814']},
                    'BENGKALIS': {'BENGKALIS': ['28711', '28712'], 'BANTAN': ['28713', '28714']},
                    'KAMPAR': {'BANGKINANG': ['28411', '28412'], 'KAMPAR KIRI': ['28413', '28414']},
                    'PELALAWAN': {'PANGKALAN KERINCI': ['28654', '28655'], 'PELALAWAN': ['28656', '28657']}
                },
                'KEPULAUAN RIAU': {
                    'BATAM': {'BATAM KOTA': ['29444', '29445'], 'SEI BEDUK': ['29446', '29447']},
                    'TANJUNG PINANG': {'TANJUNGPINANG KOTA': ['29111', '29112'], 'TANJUNGPINANG BARAT': ['29113', '29114']},
                    'BINTAN': {'BINTAN TIMUR': ['29155', '29156'], 'TELUK BINTAN': ['29157', '29158']},
                    'KARIMUN': {'KARIMUN': ['29661', '29662'], 'MORO': ['29663', '29664']},
                    'LINGGA': {'LINGGA': ['29811', '29812'], 'LINGGA UTARA': ['29813', '29814']}
                },
                'JAMBI': {
                    'JAMBI': {'JAMBI SELATAN': ['36111', '36112'], 'JAMBI TIMUR': ['36113', '36114']},
                    'SUNGAI PENUH': {'SUNGAI PENUH': ['37113', '37114'], 'PESISIR BUKIT': ['37115', '37116']},
                    'KERINCI': {'SIULAK': ['37167', '37168'], 'GUNUNG KERINCI': ['37169', '37170']},
                    'MERANGIN': {'BANGKO': ['37319', '37320'], 'JANGKAT': ['37321', '37322']},
                    'SAROLANGUN': {'SAROLANGUN': ['37419', '37420'], 'BATANG ASAI': ['37421', '37422']}
                },
                'SUMATERA SELATAN': {
                    'PALEMBANG': {'ILIR BARAT I': ['30111', '30112'], 'ILIR TIMUR I': ['30113', '30114']},
                    'LUBUKLINGGAU': {'LUBUKLINGGAU TIMUR I': ['31611', '31612'], 'LUBUKLINGGAU BARAT I': ['31613', '31614']},
                    'PAGAR ALAM': {'PAGAR ALAM SELATAN': ['31511', '31512'], 'PAGAR ALAM UTARA': ['31513', '31514']},
                    'PRABUMULIH': {'PRABUMULIH BARAT': ['31111', '31112'], 'PRABUMULIH TIMUR': ['31113', '31114']},
                    'OGAN ILIR': {'INDRALAYA': ['30862', '30863'], 'TANJUNG BATU': ['30864', '30865']}
                },
                'KEPULAUAN BANGKA BELITUNG': {
                    'PANGKALPINANG': {'PANGKALPINANG KOTA': ['33111', '33112'], 'PANGKALPINANG BARAT': ['33113', '33114']},
                    'BANGKA': {'SUNGAILIAT': ['33215', '33216'], 'BELINYU': ['33217', '33218']},
                    'BANGKA SELATAN': {'TOBOALI': ['33311', '33312'], 'SIMPANG RIMBA': ['33313', '33314']},
                    'BANGKA TENGAH': {'KOBA': ['33613', '33614'], 'PANGKALAN BARU': ['33615', '33616']},
                    'BELITUNG': {'TANJUNG PANDAN': ['33411', '33412'], 'MEMBALONG': ['33413', '33414']}
                },
                'BENGKULU': {
                    'BENGKULU': {'GADING CEMPAKA': ['38229', '38230'], 'RATU AGUNG': ['38231', '38232']},
                    'BENGKULU SELATAN': {'MANNA': ['38519', '38520'], 'KOTA MANNA': ['38521', '38522']},
                    'BENGKULU UTARA': {'ARGA MAKMUR': ['38619', '38620'], 'LAIS': ['38621', '38622']},
                    'KAUR': {'BINTUHAN': ['38911', '38912'], 'KAUR UTARA': ['38913', '38914']},
                    'REJANG LEBONG': {'CURUP': ['39519', '39520'], 'CURUP TIMUR': ['39521', '39522']}
                },
                'LAMPUNG': {
                    'BANDAR LAMPUNG': {'TANJUNG KARANG PUSAT': ['35111', '35112'], 'TELUKBETUNG UTARA': ['35113', '35114']},
                    'METRO': {'METRO PUSAT': ['34111', '34112'], 'METRO BARAT': ['34113', '34114']},
                    'LAMPUNG SELATAN': {'KALIANDA': ['35551', '35552'], 'RAJABASA': ['35553', '35554']},
                    'LAMPUNG TIMUR': {'SUKADANA': ['34319', '34320'], 'LABUHAN MARINGGAI': ['34321', '34322']},
                    'LAMPUNG TENGAH': {'GUNUNG SUGIH': ['34612', '34613'], 'KALIREJO': ['34614', '34615']}
                },
                'DKI JAKARTA': {
                    'JAKARTA PUSAT': {
                        'GAMBIR': ['10110', '10120', '10130'],
                        'TANAH ABANG': ['10160', '10230', '10240'],
                        'MENTENG': ['10310', '10320', '10330'],
                        'SENEN': ['10410', '10420', '10430'],
                        'CEMPAKA PUTIH': ['10510', '10520', '10530'],
                        'JOHAR BARU': ['10560', '10570', '10580'],
                        'KEMAYORAN': ['10610', '10620', '10630'],
                        'SAWAH BESAR': ['10710', '10720', '10730']
                    },
                    'JAKARTA SELATAN': {
                        'KEBAYORAN BARU': ['12110', '12120', '12130'],
                        'SETIABUDI': ['12910', '12920', '12930'],
                        'TEBET': ['12810', '12820', '12830'],
                        'PASAR MINGGU': ['12510', '12520', '12530'],
                        'JAGAKARSA': ['12610', '12620', '12630'],
                        'MAMPANG PRAPATAN': ['12710', '12720', '12730'],
                        'PESANGGRAHAN': ['12210', '12220', '12230'],
                        'CILANDAK': ['12410', '12420', '12430'],
                        'KEBAYORAN LAMA': ['12240', '12250', '12260'],
                        'PANCORAN': ['12760', '12770', '12780']
                    },
                    'JAKARTA TIMUR': {
                        'MATRAMAN': ['13110', '13120', '13130'],
                        'PULOGADUNG': ['13210', '13220', '13230'],
                        'JATINEGARA': ['13310', '13320', '13330'],
                        'KRAMAT JATI': ['13410', '13420', '13430'],
                        'PASAR REBO': ['13710', '13720', '13730'],
                        'CAKUNG': ['13910', '13920', '13930'],
                        'DUREN SAWIT': ['13440', '13450', '13460'],
                        'MAKASAR': ['13570', '13580', '13590'],
                        'CIRACAS': ['13740', '13750', '13760'],
                        'CIPAYUNG': ['13840', '13850', '13860']
                    },
                    'JAKARTA BARAT': {
                        'GROGOL PETAMBURAN': ['11140', '11150', '11160'],
                        'TAMAN SARI': ['11110', '11120', '11130'],
                        'TAMBORA': ['11210', '11220', '11230'],
                        'KEBON JERUK': ['11530', '11540', '11550'],
                        'KALIDERES': ['11840', '11850', '11860'],
                        'PAL MERAH': ['11480', '11490', '11500'],
                        'CENGKARENG': ['11730', '11740', '11750'],
                        'KEMBANGAN': ['11610', '11620', '11630']
                    },
                    'JAKARTA UTARA': {
                        'PENJARINGAN': ['14440', '14450', '14460'],
                        'PADEMANGAN': ['14410', '14420', '14430'],
                        'TANJUNG PRIOK': ['14310', '14320', '14330'],
                        'KOJA': ['14210', '14220', '14230'],
                        'KELAPA GADING': ['14240', '14250', '14260'],
                        'CILINCING': ['14110', '14120', '14130']
                    },
                    'KEPULAUAN SERIBU': {
                        'KEPULAUAN SERIBU UTARA': ['14710', '14720'],
                        'KEPULAUAN SERIBU SELATAN': ['14750', '14760']
                    }
                },
                'BANTEN': {
                    'SERANG': {'SERANG KOTA': ['42111', '42112'], 'KASEMEN': ['42113', '42114']},
                    'TANGERANG': {'TANGERANG KOTA': ['15111', '15112'], 'KARAWACI': ['15113', '15114']},
                    'CILEGON': {'CILEGON': ['42411', '42412'], 'CIWANDAN': ['42413', '42414']},
                    'TANGERANG SELATAN': {'SERPONG': ['15310', '15320'], 'PAMULANG': ['15330', '15340']},
                    'PANDEGLANG': {'PANDEGLANG': ['42212', '42213'], 'LABUAN': ['42214', '42215']}
                },
                'JAWA BARAT': {
                    'BANDUNG': {
                        'BANDUNG WETAN': ['40114', '40115', '40116'],
                        'COBLONG': ['40132', '40133', '40134'],
                        'SUMUR BANDUNG': ['40111', '40112', '40113'],
                        'ANDIR': ['40181', '40182', '40183'],
                        'CICENDO': ['40171', '40172', '40173'],
                        'BANDUNG KULON': ['40212', '40213', '40214'],
                        'BOJONGLOA KALER': ['40231', '40232', '40233'],
                        'ASTANA ANYAR': ['40241', '40242', '40243']
                    },
                    'BOGOR': {
                        'BOGOR TENGAH': ['16121', '16122', '16123'],
                        'BOGOR UTARA': ['16151', '16152', '16153'],
                        'BOGOR SELATAN': ['16133', '16134', '16135'],
                        'BOGOR TIMUR': ['16141', '16142', '16143'],
                        'BOGOR BARAT': ['16115', '16116', '16117'],
                        'TANAH SAREAL': ['16161', '16162', '16163']
                    },
                    'BEKASI': {
                        'BEKASI TIMUR': ['17113', '17114', '17115'],
                        'BEKASI BARAT': ['17134', '17135', '17136'],
                        'BEKASI SELATAN': ['17141', '17142', '17143'],
                        'BEKASI UTARA': ['17122', '17123', '17124'],
                        'MEDAN SATRIA': ['17131', '17132', '17133'],
                        'BANTARGEBANG': ['17151', '17152', '17153'],
                        'JATIASIH': ['17423', '17424', '17425'],
                        'JATISAMPURNA': ['17433', '17434', '17435'],
                        'MUSTIKA JAYA': ['17158', '17159', '17160'],
                        'PONDOK GEDE': ['17411', '17412', '17413'],
                        'PONDOK MELATI': ['17414', '17415', '17416'],
                        'RAWALUMBU': ['17117', '17118', '17119']
                    },
                    'DEPOK': {
                        'PANCORAN MAS': ['16431', '16432', '16433'],
                        'BEJI': ['16421', '16422', '16423'],
                        'MARGONDA': ['16424', '16425', '16426'],
                        'LIMO': ['16515', '16516', '16517'],
                        'CINERE': ['16514', '16515', '16516'],
                        'CIPAYUNG': ['16437', '16438', '16439'],
                        'SUKMAJAYA': ['16412', '16413', '16414'],
                        'CILODONG': ['16413', '16414', '16415'],
                        'TAPOS': ['16457', '16458', '16459'],
                        'CIMANGGIS': ['16451', '16452', '16453'],
                        'SAWANGAN': ['16511', '16512', '16513']
                    }
                },
                'JAWA TENGAH': {
                    'SEMARANG': {
                        'SEMARANG TENGAH': ['50134', '50135', '50136'],
                        'GAJAHMUNGKUR': ['50231', '50232', '50233'],
                        'CANDISARI': ['50232', '50233', '50234'],
                        'TEMBALANG': ['50275', '50276', '50277']
                    },
                    'SOLO': {
                        'LAWEYAN': ['57141', '57142', '57143'],
                        'SERENGAN': ['57155', '57156', '57157'],
                        'PASAR KLIWON': ['57118', '57119', '57120'],
                        'JEBRES': ['57126', '57127', '57128'],
                        'BANJARSARI': ['57134', '57135', '57136']
                    }
                },
                'DI YOGYAKARTA': {
                    'YOGYAKARTA': {
                        'GONDOKUSUMAN': ['55223', '55224', '55225'],
                        'JETIS': ['55233', '55234', '55235'],
                        'TEGALREJO': ['55243', '55244', '55245'],
                        'UMBULHARJO': ['55161', '55162', '55163'],
                        'KOTAGEDE': ['55171', '55172', '55173'],
                        'MERGANGSAN': ['55153', '55154', '55155'],
                        'BANGUNTAPAN': ['55198', '55199', '55200'],
                        'SEWON': ['55185', '55186', '55187'],
                        'KASIHAN': ['55181', '55182', '55183'],
                        'PAJANGAN': ['55911', '55912', '55913'],
                        'BANTUL': ['55711', '55712', '55713'],
                        'KRETEK': ['55772', '55773', '55774'],
                        'PUNDONG': ['55771', '55772', '55773'],
                        'BAMBANGLIPURO': ['55764', '55765', '55766'],
                        'PANDAK': ['55761', '55762', '55763']
                    },
                    'BANTUL': {
                        'BANTUL': ['55711', '55712', '55713'],
                        'SEWON': ['55185', '55186', '55187'],
                        'KASIHAN': ['55181', '55182', '55183']
                    },
                    'SLEMAN': {
                        'SLEMAN': ['55511', '55512', '55513'],
                        'DEPOK': ['55281', '55282', '55283'],
                        'MLATI': ['55288', '55289', '55290']
                    },
                    'GUNUNG KIDUL': {
                        'WONOSARI': ['55813', '55814', '55815'],
                        'PLAYEN': ['55861', '55862', '55863']
                    },
                    'KULON PROGO': {
                        'WATES': ['55611', '55612', '55613'],
                        'SENTOLO': ['55664', '55665', '55666']
                    }
                },
                'JAWA TIMUR': {
                    'SURABAYA': {'GENTENG': ['60271', '60272'], 'BUBUTAN': ['60174', '60175']},
                    'MALANG': {'KLOJEN': ['65111', '65112'], 'BLIMBING': ['65125', '65126']},
                    'KEDIRI': {'MOJOROTO': ['64112', '64113'], 'PESANTREN': ['64131', '64132']},
                    'MADIUN': {'TAMAN': ['63133', '63134'], 'KARTOHARJO': ['63117', '63118']},
                    'PROBOLINGGO': {'KADEMANGAN': ['67211', '67212'], 'MAYANGAN': ['67213', '67214']}
                },
                'BALI': {
                    'DENPASAR': {'DENPASAR SELATAN': ['80113', '80114'], 'DENPASAR TIMUR': ['80115', '80116']},
                    'BADUNG': {'MENGWI': ['80351', '80352'], 'ABIANSEMAL': ['80353', '80354']},
                    'GIANYAR': {'GIANYAR': ['80511', '80512'], 'SUKAWATI': ['80582', '80583']},
                    'TABANAN': {'TABANAN': ['82111', '82112'], 'KEDIRI': ['82121', '82122']},
                    'KLUNGKUNG': {'SEMARAPURA': ['80719', '80720'], 'BANJARANGKAN': ['80721', '80722']}
                },
                'NUSA TENGGARA BARAT': {
                    'MATARAM': {'AMPENAN': ['83114', '83115'], 'MATARAM': ['83116', '83117']},
                    'LOMBOK BARAT': {'GERUNG': ['83351', '83352'], 'KEDIRI': ['83362', '83363']},
                    'LOMBOK TENGAH': {'PRAYA': ['83511', '83512'], 'JONGGAT': ['83562', '83563']},
                    'LOMBOK TIMUR': {'SELONG': ['83611', '83612'], 'MASBAGIK': ['83661', '83662']},
                    'SUMBAWA': {'SUMBAWA BESAR': ['84316', '84317'], 'MOYO HULU': ['84372', '84373']}
                },
                'NUSA TENGGARA TIMUR': {
                    'KUPANG': {'OEBOBO': ['85228', '85229'], 'KELAPA LIMA': ['85239', '85240']},
                    'ENDE': {'ENDE SELATAN': ['86351', '86352'], 'ENDE TENGAH': ['86353', '86354']},
                    'FLORES TIMUR': {'LARANTUKA': ['86213', '86214'], 'ILE MANDIRI': ['86271', '86272']},
                    'MANGGARAI': {'RUTENG': ['86511', '86512'], 'LANGKE REMBONG': ['86563', '86564']},
                    'TIMOR TENGAH SELATAN': {'SOEOE': ['85562', '85563'], 'KUALIN': ['85613', '85614']}
                },
                'KALIMANTAN BARAT': {
                    'PONTIANAK': {'PONTIANAK KOTA': ['78111', '78112'], 'PONTIANAK SELATAN': ['78113', '78114']},
                    'SINGKAWANG': {'SINGKAWANG BARAT': ['79123', '79124'], 'SINGKAWANG TENGAH': ['79125', '79126']},
                    'KETAPANG': {'DELTA PAWAN': ['78812', '78813'], 'BENUA KAYONG': ['78851', '78852']},
                    'SINTANG': {'SINTANG': ['78619', '78620'], 'DEDAI': ['78652', '78653']},
                    'SANGGAU': {'SANGGAU KOTA': ['78511', '78512'], 'JANGKANG': ['78561', '78562']}
                },
                'KALIMANTAN TENGAH': {
                    'PALANGKA RAYA': {'PAHANDUT': ['73111', '73112'], 'SEBANGAU': ['73113', '73114']},
                    'SAMPIT': {'MENTAWA BARU KETAPANG': ['74322', '74323'], 'SERANAU': ['74371', '74372']},
                    'KUALA KAPUAS': {'SELAT': ['73519', '73520'], 'KUALA KAPUAS': ['73521', '73522']},
                    'MUARA TEWEH': {'TEWEH TENGAH': ['73811', '73812'], 'TEWEH BARU': ['73813', '73814']},
                    'PANGKALAN BUN': {'ARUT SELATAN': ['74112', '74113'], 'ARUT UTARA': ['74121', '74122']}
                },
                'KALIMANTAN SELATAN': {
                    'BANJARMASIN': {'BANJARMASIN SELATAN': ['70234', '70235'], 'BANJARMASIN TENGAH': ['70236', '70237']},
                    'BANJARBARU': {'BANJARBARU SELATAN': ['70711', '70712'], 'BANJARBARU UTARA': ['70713', '70714']},
                    'MARTAPURA': {'MARTAPURA KOTA': ['70615', '70616'], 'MARTAPURA BARAT': ['70617', '70618']},
                    'PELAIHARI': {'PELAIHARI': ['70812', '70813'], 'KURAU': ['70851', '70852']},
                    'KANDANGAN': {'KANDANGAN': ['71212', '71213'], 'ANGKINANG': ['71251', '71252']}
                },
                'KALIMANTAN TIMUR': {
                    'SAMARINDA': {'SAMARINDA ULU': ['75243', '75244'], 'SAMARINDA SEBERANG': ['75133', '75134']},
                    'BALIKPAPAN': {'BALIKPAPAN KOTA': ['76111', '76112'], 'BALIKPAPAN SELATAN': ['76113', '76114']},
                    'BONTANG': {'BONTANG BARAT': ['75313', '75314'], 'BONTANG UTARA': ['75315', '75316']},
                    'BERAU': {'TANJUNG REDEB': ['77311', '77312'], 'GUNUNG TABUR': ['77351', '77352']},
                    'KUTAI KARTANEGARA': {'TENGGARONG': ['75511', '75512'], 'SEBULU': ['75561', '75562']}
                },
                'KALIMANTAN UTARA': {
                    'TARAKAN': {'TARAKAN BARAT': ['77111', '77112'], 'TARAKAN TENGAH': ['77113', '77114']},
                    'TANJUNG SELOR': {'TANJUNG SELOR': ['77212', '77213'], 'TANJUNG PALAS': ['77251', '77252']},
                    'MALINAU': {'KOTA MALINAU': ['77511', '77512'], 'MENTARANG': ['77551', '77552']},
                    'NUNUKAN': {'NUNUKAN': ['77681', '77682'], 'SEBUKU': ['77721', '77722']},
                    'BULUNGAN': {'TANJUNG PALAS BARAT': ['77216', '77217'], 'TANJUNG PALAS TENGAH': ['77218', '77219']}
                },
                'SULAWESI UTARA': {
                    'MANADO': {'MALALAYANG': ['95163', '95164'], 'SARIO': ['95115', '95116']},
                    'BITUNG': {'MAESA': ['95512', '95513'], 'GIRIAN': ['95521', '95522']},
                    'TOMOHON': {'TOMOHON TENGAH': ['95416', '95417'], 'TOMOHON SELATAN': ['95451', '95452']},
                    'KOTAMOBAGU': {'KOTAMOBAGU BARAT': ['95711', '95712'], 'KOTAMOBAGU TIMUR': ['95713', '95714']},
                    'TAHUNA': {'TAHUNA': ['95611', '95612'], 'TAHUNA TIMUR': ['95651', '95652']}
                },
                'GORONTALO': {
                    'GORONTALO': {'KOTA SELATAN': ['96128', '96129'], 'KOTA BARAT': ['96115', '96116']},
                    'LIMBOTO': {'LIMBOTO': ['96212', '96213'], 'LIMBOTO BARAT': ['96251', '96252']},
                    'MARISA': {'MARISA': ['96315', '96316'], 'DUHIADAA': ['96351', '96352']},
                    'TILAMUTA': {'TILAMUTA': ['96519', '96520'], 'SUMALATA': ['96561', '96562']},
                    'KWANDANG': {'KWANDANG': ['96711', '96712'], 'ANGGREK': ['96751', '96752']}
                },
                'SULAWESI TENGAH': {
                    'PALU': {'PALU BARAT': ['94111', '94112'], 'PALU SELATAN': ['94113', '94114']},
                    'LUWUK': {'LUWUK': ['94711', '94712'], 'LUWUK TIMUR': ['94751', '94752']},
                    'POSO': {'POSO KOTA': ['94615', '94616'], 'POSO PESISIR': ['94651', '94652']},
                    'AMPANA': {'AMPANA KOTA': ['94371', '94372'], 'AMPANA TETE': ['94381', '94382']},
                    'BUOL': {'BUOL': ['94564', '94565'], 'BIAU': ['94571', '94572']}
                },
                'SULAWESI BARAT': {
                    'MAMUJU': {'MAMUJU': ['91511', '91512'], 'KALUKKU': ['91551', '91552']},
                    'MAJENE': {'BANGGAE': {'BANGGAE': ['91411', '91412'], 'BANGGAE TIMUR': ['91451', '91452']},
                    'POLEWALI MANDAR': {'POLEWALI': ['91311', '91312'], 'WONOMULYO': ['91351', '91352']},
                    'MAMASA': {'MAMASA': ['91362', '91363'], 'PANA': ['91371', '91372']},
                    'PASANGKAYU': {'PASANGKAYU': ['91571', '91572'], 'SARUDU': ['91581', '91582']}
                },
                'SULAWESI SELATAN': {
                    'MAKASSAR': {'MAKASSAR': ['90111', '90112'], 'MARISO': ['90113', '90114']},
                    'PAREPARE': {'UJUNG': ['91123', '91124'], 'BACUKIKI': ['91121', '91122']},
                    'PALOPO': {'WARA': ['91911', '91912'], 'WARA BARAT': ['91913', '91914']},
                    'GOWA': {'SUNGGUMINASA': ['92111', '92112'], 'SOMBA OPU': ['92113', '92114']},
                    'BONE': {'WATAMPONE': {'TANETE RIATTANG BARAT': ['92713', '92714'], 'TANETE RIATTANG TIMUR': ['92715', '92716']}}
                },
                'SULAWESI TENGGARA': {
                    'KENDARI': {'KENDARI': ['93111', '93112'], 'KENDARI BARAT': ['93113', '93114']},
                    'BAU-BAU': {'MURHUM': ['93719', '93720'], 'WOLIO': ['93721', '93722']},
                    'KOLAKA': {'KOLAKA': ['93511', '93512'], 'WATUBANGGA': ['93551', '93552']},
                    'RAHA': {'RAHA': {'KATOBU': ['93811', '93812'], 'DURUKA': ['93851', '93852']},
                    'UNAAHA': {'UNAAHA': ['93681', '93682'], 'PONDIDAHA': ['93721', '93722']}
                },
                'MALUKU UTARA': {
                    'TERNATE': {'TERNATE SELATAN': ['97728', '97729'], 'TERNATE TENGAH': ['97711', '97712']},
                    'TIDORE KEPULAUAN': {'TIDORE': ['97815', '97816'], 'OBA UTARA': ['97851', '97852']},
                    'SOFIFI': {'SOFIFI': ['97852', '97853'], 'JAILOLO': ['97681', '97682']},
                    'TOBELO': {'TOBELO': ['97762', '97763'], 'TOBELO TIMUR': ['97771', '97772']},
                    'LABUHA': {'LABUHA': ['97571', '97572'], 'SAKETA': ['97581', '97582']}
                },
                'MALUKU': {
                    'AMBON': {'SIRIMAU': ['97124', '97125'], 'BAGUALA': ['97233', '97234']},
                    'TUAL': {'DULLAH SELATAN': ['97612', '97613'], 'DULLAH UTARA': ['97651', '97652']},
                    'MASOHI': {'AMAHAI': {'AMAHAI': ['97561', '97562'], 'TEHORU': ['97571', '97572']},
                    'NAMLEA': {'NAMLEA': ['97711', '97712'], 'WAEAPO': ['97751', '97752']},
                    'DOBO': {'DOBO': ['97711', '97712'], 'ARA': ['97751', '97752']}
                },
                'PAPUA BARAT': {
                    'MANOKWARI': {'MANOKWARI BARAT': ['98315', '98316'], 'MANOKWARI SELATAN': ['98317', '98318']},
                    'SORONG': {'SORONG': ['98411', '98412'], 'SORONG TIMUR': ['98413', '98414']},
                    'FAKFAK': {'FAKFAK': {'FAKFAK': ['98612', '98613'], 'FAKFAK BARAT': ['98651', '98652']},
                    'KAIMANA': {'KAIMANA': ['98671', '98672'], 'ARGUNI BAWAH': ['98681', '98682']},
                    'BINTUNI': {'BINTUNI': ['98551', '98552'], 'MERDEY': ['98561', '98562']}
                },
                'PAPUA': {
                    'JAYAPURA': {'ABEPURA': ['99351', '99352'], 'HERAM': ['99224', '99225']},
                    'BIAK': {'BIAK KOTA': ['98111', '98112'], 'BIAK UTARA': ['98151', '98152']},
                    'MERAUKE': {'MERAUKE': ['99613', '99614'], 'SEMANGGA': ['99651', '99652']},
                    'NABIRE': {'NABIRE': ['98816', '98817'], 'UWAPA': ['98851', '98852']},
                    'TIMIKA': {'MIMIKA BARU': ['99962', '99963'], 'KUALA KENCANA': ['99971', '99972']}
                },
                'PAPUA TENGAH': {
                    'NABIRE': {'NABIRE': ['98816', '98817'], 'UWAPA': ['98851', '98852']},
                    'PANIAI': {'ENAROTALI': ['98765', '98766'], 'ARADIDE': ['98771', '98772']},
                    'DEIYAI': {'TIGI': ['98784', '98785'], 'KAPIRAYA': ['98791', '98792']},
                    'INTAN JAYA': {'SUGAPA': ['98771', '98772'], 'HITADIPA': ['98781', '98782']},
                    'DOGIYAI': {'KIGAMANI': ['98753', '98754'], 'MAPIA': ['98761', '98762']}
                },
                'PAPUA PEGUNUNGAN': {
                    'JAYAWIJAYA': {'WAMENA': ['99511', '99512'], 'ASOLOGAIMA': ['99551', '99552']},
                    'LANNY JAYA': {'TIOM': ['99571', '99572'], 'BALINGGA': ['99581', '99582']},
                    'TOLIKARA': {'KARUBAGA': ['99411', '99412'], 'BOKONDINI': ['99451', '99452']},
                    'YALIMO': {'ELELIM': ['99481', '99482'], 'APALAPSILI': ['99491', '99492']},
                    'NDUGA': {'KENYAM': ['99541', '99542'], 'GESELMA': ['99551', '99552']}
                },
                'PAPUA SELATAN': {
                    'MERAUKE': {'MERAUKE': ['99613', '99614'], 'SEMANGGA': ['99651', '99652']},
                    'BOVEN DIGOEL': {'TANAH MERAH': ['99661', '99662'], 'GETENTIRI': ['99671', '99672']},
                    'MAPPI': {'KEPI': ['99671', '99672'], 'OBAA': ['99681', '99682']},
                    'ASMAT': {'AGATS': {'AGATS': ['99777', '99778'], 'AKAT': ['99781', '99782']},
                    'YAHUKIMO': {'DEKAI': {'DEKAI': ['99651', '99652'], 'OBIO': ['99661', '99662']}
                },
                'PAPUA BARAT DAYA': {
                    'SORONG': {'SORONG': ['98411', '98412'], 'SORONG TIMUR': ['98413', '98414']},
                    'SORONG SELATAN': {'AIMAS': ['98454', '98455'], 'MAYAMUK': ['98461', '98462']},
                    'RAJA AMPAT': {'WAISAI': ['98489', '98490'], 'ARBOREK': ['98491', '98492']},
                    'TAMBRAUW': {'FIADANYON': ['98511', '98512'], 'SENOPI': ['98521', '98522']},
                    'MAYBRAT': {'KUMURKEK': {'KUMURKEK': ['98531', '98532'], 'AIFAT': ['98541', '98542']}
                }
            };

            let selectedData = {
                province: '',
                city: '',
                district: '',
                postalCode: ''
            };

            // Tab switching
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;
                    
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active');
                        btn.style.color = '#6B7280';
                        btn.style.borderColor = 'transparent';
                    });
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    this.style.color = '#072138';
                    this.style.borderColor = '#F3C32A';
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Show target tab content
                    document.getElementById(`tab-${targetTab}`).classList.remove('hidden');
                });
            });

            // Location item click handlers
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('location-item')) {
                    const value = e.target.dataset.value;
                    const nextTab = e.target.dataset.tab;
                    
                    if (nextTab === 'kota') {
                        selectedData.province = value;
                        populateKota(value);
                        switchToTab('kota');
                    } else if (nextTab === 'kecamatan') {
                        selectedData.city = value;
                        populateKecamatan(selectedData.province, value);
                        switchToTab('kecamatan');
                    } else if (nextTab === 'kodepos') {
                        selectedData.district = value;
                        populateKodePos(selectedData.province, selectedData.city, value);
                        switchToTab('kodepos');
                    } else if (e.target.dataset.type === 'postal') {
                        selectedData.postalCode = value;
                        updateSelectedLocation();
                        updateHiddenInputs();
                    }
                }
            });

            function populateKota(province) {
                const kotaTab = document.getElementById('tab-kota');
                if (locationData[province]) {
                    const cities = Object.keys(locationData[province]);
                    kotaTab.innerHTML = '<div class="space-y-1">' + 
                        cities.map(city => 
                            `<div class="location-item p-2 hover:bg-gray-100 rounded cursor-pointer" data-value="${city}" data-tab="kecamatan">${city}</div>`
                        ).join('') + 
                    '</div>';
                }
            }

            function populateKecamatan(province, city) {
                const kecamatanTab = document.getElementById('tab-kecamatan');
                if (locationData[province] && locationData[province][city]) {
                    const districts = Object.keys(locationData[province][city]);
                    kecamatanTab.innerHTML = '<div class="space-y-1">' + 
                        districts.map(district => 
                            `<div class="location-item p-2 hover:bg-gray-100 rounded cursor-pointer" data-value="${district}" data-tab="kodepos">${district}</div>`
                        ).join('') + 
                    '</div>';
                }
            }

            function populateKodePos(province, city, district) {
                const kodeposTab = document.getElementById('tab-kodepos');
                if (locationData[province] && locationData[province][city] && locationData[province][city][district]) {
                    const postalCodes = locationData[province][city][district];
                    kodeposTab.innerHTML = '<div class="space-y-1">' + 
                        postalCodes.map(code => 
                            `<div class="location-item p-2 hover:bg-gray-100 rounded cursor-pointer" data-value="${code}" data-type="postal">${code}</div>`
                        ).join('') + 
                    '</div>';
                }
            }

            function switchToTab(tabName) {
                const targetButton = document.querySelector(`[data-tab="${tabName}"]`);
                if (targetButton) {
                    targetButton.click();
                }
            }

            function updateSelectedLocation() {
                const locationDisplay = document.getElementById('selectedLocation');
                if (selectedData.province && selectedData.city && selectedData.district && selectedData.postalCode) {
                    locationDisplay.innerHTML = `${selectedData.district}, ${selectedData.city}, ${selectedData.province} ${selectedData.postalCode}`;
                } else {
                    locationDisplay.innerHTML = 'Belum memilih alamat';
                }
            }

            function updateHiddenInputs() {
                document.getElementById('selectedProvince').value = selectedData.province;
                document.getElementById('selectedCity').value = selectedData.city;
                document.getElementById('selectedDistrict').value = selectedData.district;
                document.getElementById('selectedPostalCode').value = selectedData.postalCode;
            }

            // Search functionality
            const searchInput = document.getElementById('locationSearch');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const locationItems = document.querySelectorAll('.location-item');
                
                locationItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
        };

        let currentStep = 'province';
        let breadcrumb = [];

        // Modal functions
        function openAddressModal() {
            const modal = document.getElementById('addressModal');
            if (modal) {
                modal.classList.remove('hidden');
                showProvinces();
            }
        }

        function closeAddressModal() {
            document.getElementById('addressModal').classList.add('hidden');
            resetModal();
        }

        function resetModal() {
            currentStep = 'province';
            breadcrumb = [];
            updateBreadcrumb();
            showProvinces();
        }

        // Navigation functions
        function showProvinces() {
            currentStep = 'province';
            const content = document.getElementById('modalContent');
            const provinces = Object.keys(locationData);
            
            content.innerHTML = provinces.map(province => 
                `<div class="location-option p-3 hover:bg-gray-50 cursor-pointer border-b" onclick="selectProvince('${province}')">
                    <div class="font-medium">${province}</div>
                </div>`
            ).join('');
        }

        function selectProvince(province) {
            breadcrumb = [{type: 'province', value: province, label: province}];
            document.getElementById('selectedProvince').value = province;
            updateBreadcrumb();
            showCities(province);
        }

        function showCities(province) {
            currentStep = 'city';
            const content = document.getElementById('modalContent');
            const cities = Object.keys(locationData[province] || {});
            
            if (cities.length === 0) {
                content.innerHTML = '<div class="p-4 text-center text-gray-500">Tidak ada data kota untuk provinsi ini</div>';
                return;
            }
            
            content.innerHTML = cities.map(city => 
                `<div class="location-option p-3 hover:bg-gray-50 cursor-pointer border-b" onclick="selectCity('${city}')">
                    <div class="font-medium">${city}</div>
                </div>`
            ).join('');
        }

        function selectCity(city) {
            breadcrumb.push({type: 'city', value: city, label: city});
            document.getElementById('selectedCity').value = city;
            updateBreadcrumb();
            showDistricts(breadcrumb[0].value, city);
        }

        function showDistricts(province, city) {
            currentStep = 'district';
            const content = document.getElementById('modalContent');
            const districts = Object.keys(locationData[province]?.[city] || {});
            
            if (districts.length === 0) {
                content.innerHTML = '<div class="p-4 text-center text-gray-500">Tidak ada data kecamatan untuk kota ini</div>';
                return;
            }
            
            content.innerHTML = districts.map(district => 
                `<div class="location-option p-3 hover:bg-gray-50 cursor-pointer border-b" onclick="selectDistrict('${district}')">
                    <div class="font-medium">${district}</div>
                </div>`
            ).join('');
        }

        function selectDistrict(district) {
            breadcrumb.push({type: 'district', value: district, label: district});
            document.getElementById('selectedDistrict').value = district;
            updateBreadcrumb();
            showPostalCodes(breadcrumb[0].value, breadcrumb[1].value, district);
        }

        function showPostalCodes(province, city, district) {
            currentStep = 'postal_code';
            const content = document.getElementById('modalContent');
            const postalCodes = locationData[province]?.[city]?.[district] || [];
            
            if (postalCodes.length === 0) {
                content.innerHTML = '<div class="p-4 text-center text-gray-500">Tidak ada data kode pos untuk kecamatan ini</div>';
                return;
            }
            
            content.innerHTML = postalCodes.map(postalCode => 
                `<div class="location-option p-3 hover:bg-gray-50 cursor-pointer border-b" onclick="selectPostalCode('${postalCode}')">
                    <div class="font-medium">${postalCode}</div>
                </div>`
            ).join('');
        }

        function selectPostalCode(postalCode) {
            document.getElementById('selectedPostalCode').value = postalCode;
            updateAddressDisplay();
            closeAddressModal();
        }

        // Breadcrumb functions
        function updateBreadcrumb() {
            const breadcrumbEl = document.getElementById('breadcrumb');
            
            if (breadcrumb.length === 0) {
                breadcrumbEl.innerHTML = '<span class="text-gray-600">Pilih Provinsi</span>';
                return;
            }
            
            const items = breadcrumb.map((item, index) => {
                if (index === breadcrumb.length - 1) {
                    return `<span class="font-medium" style="color: #072138;">${item.label}</span>`;
                } else {
                    return `<span class="text-blue-600 cursor-pointer hover:underline" onclick="navigateToBreadcrumb(${index})">${item.label}</span>`;
                }
            });
            
            const nextStep = getCurrentStepLabel();
            if (nextStep) {
                items.push(`<span class="text-gray-600">${nextStep}</span>`);
            }
            
            breadcrumbEl.innerHTML = items.join(' <span class="text-gray-400">></span> ');
        }

        function getCurrentStepLabel() {
            switch(currentStep) {
                case 'province': return null;
                case 'city': return 'Pilih Kota';
                case 'district': return 'Pilih Kecamatan';
                case 'postal_code': return 'Pilih Kode Pos';
                default: return null;
            }
        }

        function navigateToBreadcrumb(index) {
            // Remove items after the clicked index
            breadcrumb = breadcrumb.slice(0, index + 1);
            updateBreadcrumb();
            
            // Navigate to appropriate step
            if (index === 0) {
                showCities(breadcrumb[0].value);
            } else if (index === 1) {
                showDistricts(breadcrumb[0].value, breadcrumb[1].value);
            }
        }

        // Search functionality
        function searchLocation() {
            const searchTerm = document.getElementById('locationSearch').value.toLowerCase();
            const options = document.querySelectorAll('.location-option');
            
            options.forEach(option => {
                const text = option.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        // Update address display
        function updateAddressDisplay() {
            const province = document.getElementById('selectedProvince').value;
            const city = document.getElementById('selectedCity').value;
            const district = document.getElementById('selectedDistrict').value;
            const postalCode = document.getElementById('selectedPostalCode').value;
            
            const displayElement = document.getElementById('selectedAddressDisplay');
            
            if (province && city && district && postalCode) {
                const addressText = `${district}, ${city}, ${province} ${postalCode}`;
                displayElement.innerHTML = `<div class="font-medium" style="color: #072138;">${addressText}</div>`;
                displayElement.className = 'text-sm';
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('addressModal');
            if (e.target === modal) {
                closeAddressModal();
            }
        });

        // Initialize close button when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            const closeBtn = document.getElementById('closeModal');
            if (closeBtn) {
                closeBtn.addEventListener('click', closeAddressModal);
            }
        });
    </script>
</x-app-layout>