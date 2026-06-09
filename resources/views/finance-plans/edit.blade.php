@extends('layouts.dashboard')

@section('title', 'Edit Rencana Keuangan')
@section('header', 'Edit Rencana: ' . $plan->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('uang-beasiswa.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Daftar Rencana</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <livewire:finance-plan-calculator :plan="$plan" />
    </div>
@endsection
