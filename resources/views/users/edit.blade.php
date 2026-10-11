@extends('layouts.app')

@section('content')
    <div class="max-w-2xl"><p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">User management</p><h1 class="mt-2 text-4xl font-semibold">Edit user</h1><form method="POST" action="{{ route('users.update', $user) }}" class="mt-8 space-y-5 rounded-xl border border-white/10 bg-slate-900 p-6">@csrf @method('PUT') @include('users.form', ['submitLabel' => 'Save changes'])</form></div>
@endsection
