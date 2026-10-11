<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    /**
     * @return array{city: string, temperature: int|float, condition: string, humidity: int|float, wind_speed: int|float}|null
     */
    public function current(): ?array
    {
        $apiKey = config('services.weather.key');
        $city = config('services.weather.city');

        if (! is_string($apiKey) || $apiKey === '' || ! is_string($city) || $city === '') {
            return null;
        }

        try {
            $response = Http::connectTimeout(3)
                ->timeout(5)
                ->retry(2, 100)
                ->get(config('services.weather.endpoint'), [
                    'q' => $city,
                    'appid' => $apiKey,
                    'units' => 'metric',
                ]);

            if (! $response->successful()) {
                Log::warning('Weather API returned an unsuccessful response.', [
                    'status' => $response->status(),
                ]);

                return null;
            }

            $responseCity = $response->json('name');
            $temperature = $response->json('main.temp');
            $condition = $response->json('weather.0.description');
            $humidity = $response->json('main.humidity');
            $windSpeed = $response->json('wind.speed');

            if (! is_string($responseCity) || $responseCity === ''
                || ! is_numeric($temperature)
                || ! is_string($condition) || $condition === ''
                || ! is_numeric($humidity)
                || ! is_numeric($windSpeed)) {
                Log::warning('Weather API returned an incomplete response.');

                return null;
            }

            return [
                'city' => $responseCity,
                'temperature' => $temperature,
                'condition' => $condition,
                'humidity' => $humidity,
                'wind_speed' => $windSpeed,
            ];
        } catch (ConnectionException|\Throwable $exception) {
            Log::warning('Weather API request failed.', [
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }
}
