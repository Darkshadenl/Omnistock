<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    public function index()
    {
        return $this->weatherRequest("waalwijk");
    }

    public function showCity(Request $request, $city)
    {
        $request->merge(['city' => $city]);
        $request->validate([
            'city' => [
                'required',
                'string',
                'lte:100'
            ]
        ]);

        return $this->weatherRequest($city);
    }

    public function showLatLong(Request $request, $lat, $long)
    {
        $request->merge(['latitude' => $lat, 'longitude' => $long]);
        $request->validate([
            'latitude' => [
                'required',
                'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'
            ],
            'longitude' => [
                'required',
                'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'
            ]
        ]);

        return $this->weatherRequest("", $lat, $long);
    }

    public function weatherRequest($city = "nijmegen", $lat = 0, $long = 0)
    {
        $key = env('WEATHER_API_KEY');
        $url = "";

        if ($lat != 0 && $long != 0) {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$long}&appid={$key}";
        } else {
            $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$key}";
        }

        try {
            $response = Http::get($url);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }
}
