<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $cityId = $request->get('city_id');
        $weather = null;
        $selectedCityName = null;

       
        $cityFile = storage_path('app/big-cities.json');
        $cities = json_decode(file_get_contents($cityFile), true);

        if ($cityId) {
            foreach ($cities as $city) {
                if ($city['id'] == (int)$cityId) {
                    $selectedCityName = $city['name'];
                    $weather = $this->weatherService->getWeatherByCityId($cityId);

                    break;
                }
            }
        }

        return view('weather', compact('weather', 'selectedCityName', 'cities'));
    }
}


