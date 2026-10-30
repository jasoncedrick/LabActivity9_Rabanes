@extends('layouts.app')
@section('title', 'Sign in - Bakuna Tracker')
@section('content')
    <div class="mx-auto my-8 max-w-md">
        <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-emerald-700">Purok Rabanes</p>
        <h1 class="text-3xl font-bold">Welcome back.</h1>
        <p class="mb-7 mt-2 text-sm text-slate-500">Sign in to view your community's vaccination records.</p>
        <x-panel title="Health worker sign in">
            <form method="POST" action="{{ route('login') }}" class="space-y-5 p-6">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full rounded-lg border border-slate-300 p-3 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-200" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                    @error('email') <p id="email-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-medium">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full rounded-lg border border-slate-300 p-3 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-200" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                    @error('password') <p id="password-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
                </div>
                <button class="w-full rounded-lg bg-emerald-700 py-3 font-semibold text-white hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Sign in</button>
            </form>
        </x-panel>
    </div>
@endsection
