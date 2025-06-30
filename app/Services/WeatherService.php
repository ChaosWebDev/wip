<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public $lat, $long, $api;
    public $userAgent;

    public function __construct()
    {
        $this->lat = 45.08694;
        $this->long = -108.54222;
        $this->api = env("WEATHER_API_URL");
        $this->userAgent = "Gerber Family (jordangerber@gmail.com)";
    }

    public function forecast()
    {
        $url = "{$this->api}/points/{$this->lat},{$this->long}";
        $pointResponse = Http::withHeaders([
            'User-Agent' => $this->userAgent,
            'accept' => 'application/ld+json',
        ])->get($url);

        if (!$pointResponse->ok())
            return null;

        $forecastUrl = $pointResponse->json('forecast');

        $forecastResponse = Http::withHeaders([
            'User-Agent' => $this->userAgent,
            'Accept' => 'application/ld+json'
        ])->get($forecastUrl);

        return $forecastResponse->json('periods') ?? null;
    }

    public function alerts()
    {
        $alertsUrl = "{$this->api}/alerts/active?point={$this->lat},{$this->long}";

        $alertsResponse = Http::withHeaders([
            'User-Agent' => $this->userAgent,
            'Accept' => 'application/geo+json'
        ])->get($alertsUrl);

        if (!$alertsResponse->ok())
            return null;

        return $alertsResponse->json('features') ?? null;
    }
}
