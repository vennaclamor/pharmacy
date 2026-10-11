<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(function (Request $request): string {
            return route('dashboard', ['role' => User::normalizeRole($request->user()->role)]);
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
