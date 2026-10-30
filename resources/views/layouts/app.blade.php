<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bakuna Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <nav aria-label="Main navigation" class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-5 px-5 py-5 sm:px-8">
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 font-bold text-emerald-900">
                <span aria-hidden="true" class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-700 text-2xl text-white">+</span>
                <span>Bakuna Tracker<span class="block text-xs font-normal text-slate-500">Matina Crossing Health Center</span></span>
            </a>
            <div class="flex flex-wrap items-center gap-5 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" @class(['font-semibold', 'text-emerald-700 underline underline-offset-8' => request()->routeIs('dashboard')]) @if(request()->routeIs('dashboard')) aria-current="page" @endif>Dashboard</a>
                    <a href="{{ route('schedule') }}" @class(['font-semibold', 'text-emerald-700 underline underline-offset-8' => request()->routeIs('schedule')]) @if(request()->routeIs('schedule')) aria-current="page" @endif>Schedule</a>
                    <span class="text-slate-500">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-lg border border-slate-300 px-3 py-2 hover:bg-slate-100">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="font-semibold text-emerald-700">Sign in</a>
                @endguest
            </div>
        </nav>
    </header>
    <main class="mx-auto max-w-6xl px-5 py-10 sm:px-8">
        @yield('content')
    </main>
    <footer class="mx-auto mt-8 flex max-w-6xl flex-wrap justify-between gap-2 border-t border-slate-200 px-5 py-6 text-xs text-slate-500 sm:px-8">
        <span>Barangay Matina Crossing · Davao City</span>
        <span>Lab 9 · Rabanes · Fictional resident data</span>
    </footer>
</body>
</html>
