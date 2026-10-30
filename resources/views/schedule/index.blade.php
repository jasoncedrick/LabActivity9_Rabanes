@extends('layouts.app')
@section('title', 'Vaccination Schedule - Purok Rabanes')
@section('content')
    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-700">Community health / Schedule</p>
    <h1 class="text-3xl font-bold tracking-tight">Vaccination schedule</h1>
    <p class="mb-8 mt-2 text-sm text-slate-500">All {{ $schedules->count() }} records, arranged from earliest to latest appointment.</p>
    <x-panel title="Resident appointments">
        @include('partials.schedule-table')
    </x-panel>
    <p class="mt-5 text-sm text-slate-500">For schedule changes, please coordinate with the barangay health center.</p>
@endsection
