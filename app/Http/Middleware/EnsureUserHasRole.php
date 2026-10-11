<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $role = $role === '{role}' ? (string) $request->route('role') : $role;
        $role = User::normalizeRole($role);

        abort_unless(User::normalizeRole((string) $request->user()?->role) === $role, 403);

        return $next($request);
    }
}
