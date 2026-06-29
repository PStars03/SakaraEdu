@extends('layouts.dashboard')

@section('title', 'Detail Rencana Keuangan')
@section('header', 'Detail Rencana: ' . $plan->title)

@php
    $amount = (float) $plan->scholarship_amount;
    $totalDays = 180;
    $totalMonths = 6;

    // Calculate amounts from stored nominal costs
    $rentTotal = $plan->uses_rent && $plan->rent_cost ? (float) $plan->rent_cost * $totalMonths : 0;
    $transportTotal = $plan->uses_transport && $plan->transport_cost ? (float) $plan->transport_cost * $totalDays : 0;
    $remaining = max(0, $amount - $rentTotal - $transportTotal);

    // Use stored percentages to derive food/saving/other from remaining
    // Or recalculate using the same ratio logic
    $foodPct = $plan->food_percentage;
    $savingPct = $plan->saving_percentage;
    $otherPct = $plan->other_percentage;
    $remainingPctSum = $foodPct + $savingPct + $otherPct;

    $foodAmount = $remainingPctSum > 0 ? ($foodPct / $remainingPctSum) * $remaining : 0;
    $savingAmount = $remainingPctSum > 0 ? ($savingPct / $remainingPctSum) * $remaining : 0;
    $otherAmount = $remainingPctSum > 0 ? ($otherPct / $remainingPctSum) * $remaining : 0;
@endphp

@section('content')
    <div class="mb-4">
        <a href="{{ route('uang-beasiswa.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Daftar Rencana</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <!-- Header -->
        <div class="mb-8 grid gap-6 sm:grid-cols-2">
            <div>
                <h3 class="text-lg font-bold text-deep-navy mb-1">{{ $plan->title }}</h3>
                <p class="text-sm text-slate-500">Dibuat pada: {{ $plan->created_at->format('d F Y') }}</p>
                <div class="mt-4 flex gap-2">
                    @if($plan->uses_transport)
                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                            Transport: Rp {{ number_format($plan->transport_cost, 0, ',', '.') }}/hari
                        </span>
                    @endif
                    @if($plan->uses_rent)
                        <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-600/20">
                            Kos: Rp {{ number_format($plan->rent_cost, 0, ',', '.') }}/bulan
                        </span>
                    @endif
                </div>
            </div>
            <div class="sm:text-right">
                <p class="text-sm font-medium text-slate-500">Total Uang Beasiswa</p>
                <p class="text-3xl font-bold text-primary-blue">Rp {{ number_format($amount, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-400 mt-1">Durasi: {{ $totalMonths }} bulan ({{ $totalDays }} hari)</p>
            </div>
        </div>

        <!-- Detailed Allocation Cards -->
        <div class="rounded-2xl bg-soft-bg p-6">
            <h4 class="mb-4 text-base font-semibold text-deep-navy border-b border-slate-200 pb-2">Rincian Alokasi per Semester</h4>
            <div class="space-y-3">

                @if($plan->uses_rent && $rentTotal > 0)
                <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            </span>
                            <span class="text-sm font-medium text-slate-700">Biaya Kos / Tempat Tinggal</span>
                        </div>
                        <span class="font-bold text-deep-navy">Rp {{ number_format($rentTotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1 rounded-md bg-purple-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Rp {{ number_format($plan->rent_cost, 0, ',', '.') }} / bulan
                        </span>
                    </div>
                </div>
                @endif

                <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            </span>
                            <span class="text-sm font-medium text-slate-700">Uang Makan</span>
                        </div>
                        <span class="font-bold text-deep-navy">Rp {{ number_format($foodAmount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1 rounded-md bg-orange-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Rp {{ number_format($foodAmount / $totalDays, 0, ',', '.') }} / hari
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-md bg-orange-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Rp {{ number_format($foodAmount / $totalMonths, 0, ',', '.') }} / bulan
                        </span>
                    </div>
                </div>

                @if($plan->uses_transport && $transportTotal > 0)
                <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            </span>
                            <span class="text-sm font-medium text-slate-700">Uang Transport</span>
                        </div>
                        <span class="font-bold text-deep-navy">Rp {{ number_format($transportTotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Rp {{ number_format($plan->transport_cost, 0, ',', '.') }} / hari
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Rp {{ number_format($transportTotal / $totalMonths, 0, ',', '.') }} / bulan
                        </span>
                    </div>
                </div>
                @endif

                <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-green-100 text-green-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </span>
                            <span class="text-sm font-medium text-slate-700">Tabungan / Investasi</span>
                        </div>
                        <span class="font-bold text-fresh-green">Rp {{ number_format($savingAmount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1 rounded-md bg-green-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Rp {{ number_format($savingAmount / $totalMonths, 0, ',', '.') }} / bulan
                        </span>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <span class="text-sm font-medium text-slate-700">Lain-lain / Dana Darurat</span>
                        </div>
                        <span class="font-bold text-deep-navy">Rp {{ number_format($otherAmount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Rp {{ number_format($otherAmount / $totalDays, 0, ',', '.') }} / hari
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2 py-0.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Rp {{ number_format($otherAmount / $totalMonths, 0, ',', '.') }} / bulan
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Total -->
            <div class="mt-4 rounded-xl bg-gradient-to-r from-primary-blue to-deep-navy p-4 text-white shadow-md">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-bold">Total Keseluruhan</span>
                    <span class="text-lg font-bold">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex gap-3 text-xs text-white/70">
                    <span>≈ Rp {{ number_format($amount / $totalMonths, 0, ',', '.') }} / bulan</span>
                    <span>≈ Rp {{ number_format($amount / $totalDays, 0, ',', '.') }} / hari</span>
                </div>
            </div>

            @if($remaining < $amount)
            <div class="mt-3 rounded-xl bg-slate-50 border border-slate-200 p-3 text-xs text-slate-500">
                <span class="font-medium text-slate-600">Sisa setelah Kos & Transport:</span> Rp {{ number_format($remaining, 0, ',', '.') }}
                — dialokasikan untuk makan, tabungan, dan lain-lain.
            </div>
            @endif
        </div>

        <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ route('uang-beasiswa.edit', $plan->id) }}" class="rounded-xl bg-primary-blue px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
                Edit Rencana
            </a>
            <a href="{{ route('uang-beasiswa.pdf', $plan->id) }}"
               class="inline-flex items-center gap-2 rounded-xl border border-primary-blue bg-white px-6 py-2 text-sm font-semibold text-primary-blue shadow-sm hover:bg-blue-50 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Download PDF
            </a>
            <form action="{{ route('uang-beasiswa.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rencana ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-xl border border-red-500 text-red-500 bg-white px-6 py-2 text-sm font-semibold shadow-sm hover:bg-red-50 transition-colors">
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endsection
