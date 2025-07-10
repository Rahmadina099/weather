<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = config('services.openweather.api_key');
    }

   public function getWeatherByCityId(string $cityId)
{
    $response = Http::get($this->baseUrl, [
        'id' => $cityId,
        'appid' => $this->apiKey,
        'units' => 'metric',
    ]);

    if ($response->successful()) {
        return $response->json();
    }

    return null;
}

}
