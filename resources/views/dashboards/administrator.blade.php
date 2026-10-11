@extends('layouts.app')

@section('content')
<div class="mb-10 flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Administrator dashboard</p><h1 class="mt-3 text-4xl font-semibold tracking-tight">Welcome Administrator!</h1><p class="mt-3 max-w-xl text-slate-400">Oversee users, pharmacy operations, branches, and system access.</p></div><a href="{{ route('users.index') }}" class="rounded-md bg-cyan-300 px-4 py-2.5 font-semibold text-slate-950 hover:bg-cyan-200">Manage users</a></div>
<section class="grid gap-4 sm:grid-cols-3"><div><p>Access level</p><p>Full system access</p></div><div><p>Primary responsibility</p><p>System oversight</p></div><div><p>Authorized area</p><p>User management</p></div></section>
<section class="mt-8 rounded-xl border border-cyan-300/20 bg-slate-900 p-6">
	@if ($weather)
		<div class="grid gap-4 sm:grid-cols-5">
			<div><p class="text-sm text-slate-400">Location</p><p class="mt-1 text-xl font-semibold">{{ $weather['city'] }}</p></div>
			<div><p class="text-sm text-slate-400">Temperature</p><p class="mt-1 text-xl font-semibold">{{ $weather['temperature'] }} &deg;C</p></div>
			<div><p class="text-sm text-slate-400">Condition</p><p class="mt-1 text-xl font-semibold capitalize">{{ $weather['condition'] }}</p></div>
			<div><p class="text-sm text-slate-400">Humidity</p><p class="mt-1 text-xl font-semibold">{{ $weather['humidity'] }}%</p></div>
			<div><p class="text-sm text-slate-400">Wind speed</p><p class="mt-1 text-xl font-semibold">{{ $weather['wind_speed'] }} m/s</p></div>
		</div>
	@else
		<p class="text-slate-400">Weather information is currently unavailable. The rest of the dashboard remains available.</p>
	@endif
</section>
@endsection
