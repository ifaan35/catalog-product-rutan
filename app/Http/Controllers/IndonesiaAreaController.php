<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndonesiaAreaController extends Controller
{
    private $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';

    /**
     * Mengambil daftar provinsi dari API
     */
    public function getProvinces()
    {
        try {
            $response = Http::get($this->baseUrl . '/provinces.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Failed to fetch provinces'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil daftar kab/kota berdasarkan province_id
     */
    public function getRegencies($provinceId)
    {
        try {
            $response = Http::get($this->baseUrl . '/regencies/' . $provinceId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Failed to fetch regencies'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil daftar kecamatan berdasarkan regency_id
     */
    public function getDistricts($regencyId)
    {
        try {
            $response = Http::get($this->baseUrl . '/districts/' . $regencyId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Failed to fetch districts'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil daftar kelurahan berdasarkan district_id
     */
    public function getVillages($districtId)
    {
        try {
            $response = Http::get($this->baseUrl . '/villages/' . $districtId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Failed to fetch villages'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil data provinsi berdasarkan ID
     */
    public function getProvince($provinceId)
    {
        try {
            $response = Http::get($this->baseUrl . '/province/' . $provinceId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Province not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil data kab/kota berdasarkan ID
     */
    public function getRegency($regencyId)
    {
        try {
            $response = Http::get($this->baseUrl . '/regency/' . $regencyId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Regency not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil data kecamatan berdasarkan ID
     */
    public function getDistrict($districtId)
    {
        try {
            $response = Http::get($this->baseUrl . '/district/' . $districtId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'District not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mengambil data kelurahan berdasarkan ID
     */
    public function getVillage($villageId)
    {
        try {
            $response = Http::get($this->baseUrl . '/village/' . $villageId . '.json');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json(['error' => 'Village not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
