<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aegis Pharmacy' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @include('partials.fallback-styles')
</head>
<body class="app-shell min-h-screen bg-slate-950 text-slate-100">
    <header class="border-b border-white/10 bg-slate-900/80">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ auth()->check() ? route('dashboard', ['role' => auth()->user()->role]) : route('login') }}" class="text-lg font-semibold tracking-tight">Aegis Pharmacy</a>
            @auth
                <div class="flex items-center gap-4 text-sm">
                    <span class="text-slate-400">{{ auth()->user()->name }} · {{ \App\Models\User::ROLE_LABELS[\App\Models\User::normalizeRole(auth()->user()->role)] ?? auth()->user()->role }}</span>
                    @if (auth()->user()->role === 'administrator')
                        <a href="{{ route('users.index') }}" class="text-cyan-300 hover:text-cyan-200">Manage users</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-md border border-white/15 px-3 py-1.5 hover:bg-white/10" type="submit">Log out</button>
                    </form>
                </div>
            @endauth
        </div>
    </header>
    <main class="mx-auto max-w-6xl px-6 py-10">
        @if (session('status'))
            <div class="mb-6 rounded-md border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-emerald-200">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
