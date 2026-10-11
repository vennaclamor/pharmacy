@extends('layouts.app')

@section('content')
    <div class="mb-10 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">{{ $roleLabel }} dashboard</p>
            <h1 class="mt-3 text-4xl font-semibold tracking-tight">Welcome {{ $roleLabel }}!</h1>
            <p class="mt-3 max-w-xl text-slate-400">You are signed in to the Aegis Pharmacy Management System.</p>
        </div>
        @if ($role === 'administrator')
            <a href="{{ route('users.index') }}" class="rounded-md bg-cyan-300 px-4 py-2.5 font-semibold text-slate-950 hover:bg-cyan-200">Open user management</a>
        @endif
    </div>
    <section class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-white/10 bg-slate-900 p-5"><p class="text-sm text-slate-400">Assigned role</p><p class="mt-2 text-xl font-semibold">{{ $roleLabel }}</p></div>
        <div class="rounded-xl border border-white/10 bg-slate-900 p-5"><p class="text-sm text-slate-400">Access status</p><p class="mt-2 text-xl font-semibold text-emerald-300">Authorized</p></div>
        <div class="rounded-xl border border-white/10 bg-slate-900 p-5"><p class="text-sm text-slate-400">System</p><p class="mt-2 text-xl font-semibold">Aegis Pharmacy</p></div>
    </section>
@endsection
