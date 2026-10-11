<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in · Aegis Pharmacy</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @include('partials.fallback-styles')
</head>
<body class="auth-page flex min-h-screen items-center justify-center bg-slate-950 px-6 text-slate-100">
    <main class="w-full max-w-md rounded-2xl border border-white/10 bg-slate-900 p-8 shadow-2xl">
        <p class="mb-3 text-sm font-semibold uppercase tracking-[0.25em] text-cyan-300">Aegis Pharmacy</p>
        <h1 class="text-3xl font-semibold">Sign in to your workspace</h1>
        <p class="mt-2 text-slate-400">Your role determines the dashboard you can access.</p>
        @if ($errors->any())
            <div class="mt-6 rounded-md border border-rose-400/30 bg-rose-400/10 px-4 py-3 text-rose-200">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
            @csrf
            <label class="block text-sm text-slate-300">Email<input name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-md border border-white/15 bg-slate-950 px-3 py-2.5 text-white outline-none focus:border-cyan-300"></label>
            <label class="block text-sm text-slate-300">Password<input name="password" type="password" required class="mt-2 w-full rounded-md border border-white/15 bg-slate-950 px-3 py-2.5 text-white outline-none focus:border-cyan-300"></label>
            <label class="flex items-center gap-2 text-sm text-slate-400"><input name="remember" type="checkbox" value="1" class="accent-cyan-400"> Remember me</label>
            <button type="submit" class="w-full rounded-md bg-cyan-300 px-4 py-3 font-semibold text-slate-950 hover:bg-cyan-200">Sign in</button>
        </form>
        <p class="auth-register-link">New to Aegis Pharmacy? <a href="{{ route('register') }}">Create a customer account</a></p>
    </main>
</body>
</html>
