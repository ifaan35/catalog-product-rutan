<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat negara Indonesia
        $indonesia = Country::create([
            'name' => 'Indonesia',
            'code' => 'ID'
        ]);

        // Data provinsi Indonesia dengan kota-kota utama
        $provinces = [
            'DKI Jakarta' => [
                'Jakarta Pusat' => ['10110', '10120', '10130'],
                'Jakarta Utara' => ['14210', '14220', '14230'],
                'Jakarta Barat' => ['11110', '11120', '11130'],
                'Jakarta Selatan' => ['12110', '12120', '12130'],
                'Jakarta Timur' => ['13110', '13120', '13130']
            ],
            'Jawa Barat' => [
                'Bandung' => ['40111', '40112', '40113'],
                'Bekasi' => ['17112', '17113', '17114'],
                'Bogor' => ['16111', '16112', '16113'],
                'Depok' => ['16411', '16412', '16413'],
                'Cimahi' => ['40511', '40512', '40513']
            ],
            'Jawa Tengah' => [
                'Semarang' => ['50111', '50112', '50113'],
                'Solo' => ['57111', '57112', '57113'],
                'Yogyakarta' => ['55111', '55112', '55113'],
                'Magelang' => ['56111', '56112', '56113'],
                'Pekalongan' => ['51111', '51112', '51113']
            ],
            'Jawa Timur' => [
                'Surabaya' => ['60111', '60112', '60113'],
                'Malang' => ['65111', '65112', '65113'],
                'Kediri' => ['64111', '64112', '64113'],
                'Madiun' => ['63111', '63112', '63113'],
                'Probolinggo' => ['67111', '67112', '67113']
            ],
            'Sumatera Utara' => [
                'Medan' => ['20111', '20112', '20113'],
                'Binjai' => ['20711', '20712', '20713'],
                'Pematangsiantar' => ['21111', '21112', '21113'],
                'Tanjungbalai' => ['21311', '21312', '21313']
            ]
        ];

        foreach ($provinces as $provinceName => $cities) {
            $province = Province::create([
                'country_id' => $indonesia->id,
                'name' => $provinceName
            ]);

            foreach ($cities as $cityName => $postalCodes) {
                foreach ($postalCodes as $postalCode) {
                    City::create([
                        'province_id' => $province->id,
                        'name' => $cityName,
                        'postal_code' => $postalCode
                    ]);
                }
            }
        }
    }
}
