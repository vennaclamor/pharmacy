@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div><p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Administrator tools</p><h1 class="mt-2 text-4xl font-semibold">User management</h1><p class="mt-2 text-slate-400">Create, review, update, and remove system accounts.</p></div>
        <a href="{{ route('users.create') }}" class="rounded-md bg-cyan-300 px-4 py-2.5 font-semibold text-slate-950 hover:bg-cyan-200">Add user</a>
    </div>
    <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-slate-900">
        <table class="w-full text-left text-sm"><thead class="border-b border-white/10 text-slate-400"><tr><th class="px-5 py-4">Name</th><th class="px-5 py-4">Email</th><th class="px-5 py-4">Role</th><th class="px-5 py-4 text-right">Actions</th></tr></thead><tbody class="divide-y divide-white/10">
        @forelse ($users as $user)
            <tr><td class="px-5 py-4 font-medium">{{ $user->name }}</td><td class="px-5 py-4 text-slate-300">{{ $user->email }}</td><td class="px-5 py-4"><span class="rounded-full bg-cyan-300/10 px-3 py-1 text-cyan-200">{{ \App\Models\User::ROLE_LABELS[$user->role] ?? $user->role }}</span></td><td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('users.edit', $user) }}" class="text-cyan-300 hover:text-cyan-200">Edit</a><form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">@csrf @method('DELETE')<button type="submit" class="text-rose-300 hover:text-rose-200">Delete</button></form></div></td></tr>
        @empty
            <tr><td colspan="4" class="px-5 py-10 text-center text-slate-400">No users found.</td></tr>
        @endforelse
        </tbody></table>
    </div>
@endsection
