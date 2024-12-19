<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    public function provinces()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => '20fe0c18701bd8e8d4243d5ace786d45'
            ]
        ]);

        return response()->json(json_decode($response->getBody()->getContents()));
    }

    public function cities(int $provinceId)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city?province=' . $provinceId, [
            'headers' => [
                'key' => '20fe0c18701bd8e8d4243d5ace786d45',
            ],
        ]);

        return response()->json(json_decode($response->getBody()->getContents()));
    }

    public function cekOngkir(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => '20fe0c18701bd8e8d4243d5ace786d45',
            ],
            "form_params" => [
                "origin" => $request->origin,
                "destination" => $request->destination,
                "weight" => $request->weight,
                "courier" => $request->courier
            ]
        ]);

        return response()->json(json_decode($response->getBody()->getContents()));
    }

}
