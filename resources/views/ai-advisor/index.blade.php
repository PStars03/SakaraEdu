@extends('layouts.dashboard')

@section('title', 'AI Financial Advisor')
@section('header', 'AI Student Financial Advisor')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-200 flex items-start gap-3">
            <svg class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Header section --}}
    <div class="mb-8 rounded-2xl bg-gradient-to-r from-deep-navy to-primary-blue p-6 text-white shadow-md">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold mb-1">Riwayat Analisis Keuangan</h2>
                <p class="text-white/70 text-sm">Semua analisis AI yang pernah Anda buat tersimpan di sini.</p>
            </div>
            <a href="{{ route('ai-advisor.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-primary-blue shadow-sm hover:bg-blue-50 transition-colors flex-shrink-0">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Analisis Baru
            </a>
        </div>
    </div>

    @if($planners->isEmpty())
        <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-16 text-center animate-fade-up">
            <img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="Empty" class="h-16 w-16 opacity-20 grayscale mb-4">
            <h3 class="text-lg font-semibold text-deep-navy">Belum ada analisis</h3>
            <p class="mt-2 text-sm text-slate-500 max-w-sm">
                Mulai buat analisis keuangan semester pertama Anda dan dapatkan saran dari AI SakaraEdu.
            </p>
            <a href="{{ route('ai-advisor.create') }}"
               class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary-blue px-6 py-2.5 text-sm font-semibold text-white hover:bg-deep-navy transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Mulai Analisis
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($planners as $planner)
                <div class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 animate-fade-up"
                     style="animation-delay: {{ $loop->index * 60 }}ms">

                    {{-- Major badge --}}
                    <div class="mb-4 flex items-start justify-between">
                        <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-primary-blue">
                            {{ $planner->major }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $planner->created_at->format('d M Y') }}</span>
                    </div>

                    {{-- Expense vs Fund --}}
                    <div class="mb-4 rounded-xl bg-soft-bg p-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Total Pengeluaran</span>
                            <span class="font-semibold text-slate-800">Rp {{ number_format($planner->total_expense, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Dana Tersedia</span>
                            <span class="font-semibold text-primary-blue">Rp {{ number_format($planner->self_fund, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Surplus / Deficit badge --}}
                    <div class="mb-4">
                        @if($planner->isSurplus())
                            <span class="inline-flex items-center gap-1 rounded-lg bg-green-50 border border-green-200 px-3 py-1.5 text-xs font-semibold text-green-700">
                                ✅ {{ $planner->surplusDeficitLabel }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-lg bg-red-50 border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-700">
                                ⚠️ {{ $planner->surplusDeficitLabel }}
                            </span>
                        @endif
                    </div>

                    {{-- AI badge --}}
                    <div class="mb-5 flex-grow">
                        @if($planner->ai_response_text)
                            <span class="inline-flex items-center gap-1 text-xs text-sky-blue font-medium">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Analisis AI tersedia
                            </span>
                        @else
                            <span class="text-xs text-slate-400">Tidak ada analisis AI</span>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <a href="{{ route('ai-advisor.show', $planner->id) }}"
                           class="text-sm font-semibold text-primary-blue hover:text-deep-navy transition-colors">
                            Lihat Detail →
                        </a>
                        <form action="{{ route('ai-advisor.destroy', $planner->id) }}" method="POST"
                              onsubmit="return confirm('Hapus riwayat analisis ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors rounded-lg hover:bg-red-50" title="Hapus">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
