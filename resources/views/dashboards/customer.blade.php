@extends('layouts.app')

@section('content')
<div class="mb-10"><p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Customer dashboard</p><h1 class="mt-3 text-4xl font-semibold tracking-tight">Welcome Customer!</h1><p class="mt-3 max-w-xl text-slate-400">View your pharmacy account and keep track of your customer activity.</p></div>
<section class="grid gap-4 sm:grid-cols-3"><div><p>Account type</p><p>Customer account</p></div><div><p>Primary responsibility</p><p>Personal profile</p></div><div><p>Authorized area</p><p>Customer services</p></div></section>
@endsection
