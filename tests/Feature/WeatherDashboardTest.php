<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrator_dashboard_displays_mapped_weather_data(): void
    {
        config([
            'services.weather.key' => 'test-key',
            'services.weather.city' => 'Manila',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://api.openweathermap.org/data/2.5/weather*' => Http::response([
                'name' => 'Manila',
                'main' => ['temp' => 29.5, 'humidity' => 78],
                'weather' => [['description' => 'light rain']],
                'wind' => ['speed' => 3.2],
            ]),
        ]);

        $response = $this->actingAs(User::factory()->create(['role' => 'administrator']))
            ->get(route('dashboard', ['role' => 'administrator']));

        $response->assertOk()
            ->assertSee('Manila')
            ->assertSee('29.5')
            ->assertSee('light rain')
            ->assertSee('78%')
            ->assertSee('3.2 m/s');
        Http::assertSent(fn ($request): bool => $request->data()['q'] === 'Manila'
            && $request->data()['units'] === 'metric');
    }

    public function test_administrator_dashboard_shows_fallback_when_weather_api_fails(): void
    {
        config([
            'services.weather.key' => 'test-key',
            'services.weather.city' => 'Manila',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://api.openweathermap.org/data/2.5/weather*' => Http::failedConnection(),
        ]);

        $response = $this->actingAs(User::factory()->create(['role' => 'administrator']))
            ->get(route('dashboard', ['role' => 'administrator']));

        $response->assertOk()
            ->assertSee('Weather information is currently unavailable.')
            ->assertSee('Manage users');
    }

    public function test_administrator_dashboard_shows_fallback_for_an_api_error_response(): void
    {
        config([
            'services.weather.key' => 'test-key',
            'services.weather.city' => 'Manila',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://api.openweathermap.org/data/2.5/weather*' => Http::response([
                'message' => 'Invalid API key',
            ], 401),
        ]);

        $response = $this->actingAs(User::factory()->create(['role' => 'administrator']))
            ->get(route('dashboard', ['role' => 'administrator']));

        $response->assertOk()
            ->assertSee('Weather information is currently unavailable.');
    }
}
