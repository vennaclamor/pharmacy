<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WeatherService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly WeatherService $weatherService) {}

    public function pharmacist(): View
    {
        return $this->show('pharmacist-manager');
    }

    public function cashier(): View
    {
        return $this->show('cashier-sales-staff');
    }

    public function supplier(): View
    {
        return $this->show('supplier-vendor');
    }

    public function show(string $role): View
    {
        abort_unless(array_key_exists($role, User::ROLE_LABELS), 404);

        $viewData = [
            'role' => $role,
            'roleLabel' => User::ROLE_LABELS[$role],
        ];

        if ($role === 'administrator') {
            $viewData['weather'] = $this->weatherService->current();
        }

        return view('dashboards.'.$role, $viewData);
    }
}
