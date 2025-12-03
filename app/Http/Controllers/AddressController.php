<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Mengambil data Provinsi berdasarkan ID Negara.
     */
    public function getProvinces($country_id)
    {
        $provinces = Province::where('country_id', $country_id)
                             ->orderBy('name')
                             ->get(['id', 'name']);

        return response()->json($provinces);
    }

    /**
     * Mengambil data Kota berdasarkan ID Provinsi.
     */
    public function getCities($province_id)
    {
        $cities = City::where('province_id', $province_id)
                       ->orderBy('name')
                       ->get(['id', 'name', 'postal_code']);

        return response()->json($cities);
    }
}
