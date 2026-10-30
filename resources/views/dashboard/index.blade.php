@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-700">Community health / Overview</p>
            <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">{{ $title }}</h1>
            <p class="mt-2 text-sm text-slate-500">A clear view of vaccinations in our community.</p>
        </div>
        <a href="{{ route('schedule') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-800">View schedule &rarr;</a>
    </div>
    <div class="mb-7 grid gap-4 md:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card :title="$stat['label']" :value="$stat['value']" />
        @endforeach
    </div>
    <div role="status" class="mb-7 rounded-xl border border-amber-200 bg-amber-50 px-6 py-4 text-sm text-amber-950">
        @if ($alerts->isNotEmpty())
            <p class="font-semibold">{{ $alerts->count() }} overdue vaccination(s) need follow-up.</p>
            <p class="mt-1">Please remind these residents about their next visit to the health center.</p>
        @elseif ($outOfStock)
            <p class="font-semibold">Vaccine stock notice</p>
            <p class="mt-1">A vaccine is out of stock. Confirm availability before scheduling a visit.</p>
        @else
            <p class="font-semibold">All clear</p>
            <p class="mt-1">There are no overdue vaccinations to follow up.</p>
        @endif
    </div>
    <x-panel title="Vaccination overview">
        @include('partials.schedule-table')
    </x-panel>
@endsection
