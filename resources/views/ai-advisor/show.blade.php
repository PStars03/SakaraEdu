@extends('layouts.dashboard')

@section('title', 'Hasil Analisis AI — ' . $planner->major)
@section('header', 'Hasil Analisis AI')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('ai-advisor.index') }}"
           class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">
            ← Kembali ke Riwayat
        </a>
        <span class="text-xs text-slate-400">{{ $planner->created_at->format('d F Y, H:i') }}</span>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-xl bg-green-50 border border-green-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-green-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Summary Card --}}
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-deep-navy to-primary-blue p-6 text-white shadow-md animate-fade-up">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <p class="text-white/60 text-sm mb-1">Program Studi</p>
                <h2 class="text-2xl font-bold">{{ $planner->major }}</h2>
            </div>
            <div class="text-right">
                @if($planner->isSurplus())
                    <span class="inline-flex items-center gap-1 rounded-xl bg-green-400/20 border border-green-400/40 px-4 py-2 text-sm font-bold text-green-300">
                        ✅ {{ $planner->surplusDeficitLabel }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 rounded-xl bg-red-400/20 border border-red-400/40 px-4 py-2 text-sm font-bold text-red-300">
                        ⚠️ {{ $planner->surplusDeficitLabel }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- LEFT: Rincian Kalkulasi --}}
        <div class="lg:col-span-1 space-y-4 animate-fade-up">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-deep-navy mb-4 pb-3 border-b border-slate-100">
                    Rincian Kebutuhan Semester
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Biaya UKT/SPP</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($planner->ukt_fee, 0, ',', '.') }}</span>
                    </div>

                    @if($planner->monthly_rent)
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-500">Kos/Sewa</span>
                            <span class="ml-1 text-xs text-slate-400">(6 bln)</span>
                        </div>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($planner->monthly_rent * 6, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-500">Konsumsi</span>
                            <span class="ml-1 text-xs text-slate-400">(6 bln)</span>
                        </div>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($planner->monthly_consumption * 6, 0, ',', '.') }}</span>
                    </div>

                    @if($planner->monthly_transport)
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-500">Transportasi</span>
                            <span class="ml-1 text-xs text-slate-400">(180 hari)</span>
                        </div>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($planner->monthly_transport * 180, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="pt-3 border-t border-slate-100">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-slate-700">Total Pengeluaran</span>
                            <span class="font-bold text-deep-navy">Rp {{ number_format($planner->total_expense, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-slate-700">Dana Tersedia</span>
                            <span class="font-bold text-primary-blue">Rp {{ number_format($planner->self_fund, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="rounded-xl p-3 {{ $planner->isSurplus() ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                        <div class="flex justify-between">
                            <span class="font-bold {{ $planner->isSurplus() ? 'text-green-700' : 'text-red-700' }}">
                                {{ $planner->isSurplus() ? 'Surplus' : 'Defisit' }}
                            </span>
                            <span class="font-bold {{ $planner->isSurplus() ? 'text-green-700' : 'text-red-700' }}">
                                Rp {{ number_format(abs($planner->surplus_deficit), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-deep-navy mb-4">Aksi</h3>
                <div class="space-y-3">
                    {{-- Download PDF (opsional) --}}
                    <a href="{{ route('ai-advisor.pdf', $planner->id) }}"
                       class="flex items-center gap-2 w-full rounded-xl border border-primary-blue px-4 py-2.5 text-sm font-semibold text-primary-blue hover:bg-blue-50 transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download PDF (Opsional)
                    </a>

                    {{-- Regenerate AI (tampil hanya jika belum ada response) --}}
                    @if(!$planner->ai_response_text)
                    <form action="{{ route('ai-advisor.regenerate', $planner->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-2 w-full rounded-xl bg-sky-blue px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-blue transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Coba Ulang Analisis AI
                        </button>
                    </form>
                    @endif

                    {{-- Analisis Baru --}}
                    <a href="{{ route('ai-advisor.create') }}"
                       class="flex items-center gap-2 w-full rounded-xl bg-primary-blue px-4 py-2.5 text-sm font-semibold text-white hover:bg-deep-navy transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Analisis Baru
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('ai-advisor.destroy', $planner->id) }}" method="POST"
                          onsubmit="return confirm('Hapus riwayat analisis ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="flex items-center gap-2 w-full rounded-xl border border-red-300 px-4 py-2.5 text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Riwayat
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT: AI Response --}}
        <div class="lg:col-span-2 animate-fade-up">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm h-full">
                <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-sky-blue to-primary-blue text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-deep-navy">Analisis AI SakaraEdu</h3>
                        <p class="text-xs text-slate-400">Dipersonalisasi untuk jurusan {{ $planner->major }}</p>
                    </div>
                </div>

                @if($planner->ai_response_text)
                    {{-- Render Markdown as HTML --}}
                    <div class="prose prose-sm max-w-none prose-headings:text-deep-navy prose-headings:font-bold prose-p:text-slate-600 prose-li:text-slate-600 prose-strong:text-slate-800">
                        {!! \Illuminate\Support\Str::markdown($planner->ai_response_text) !!}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-amber-50 border border-amber-200">
                            <svg class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">Analisis AI gagal dibuat</p>
                        <p class="text-xs text-slate-400 mt-1 max-w-xs">
                            Terjadi kendala saat menghubungi server AI. Coba buat analisis baru untuk mencoba lagi.
                        </p>
                        <a href="{{ route('ai-advisor.create') }}"
                           class="mt-4 inline-flex items-center gap-1.5 rounded-lg bg-primary-blue px-4 py-2 text-xs font-semibold text-white hover:bg-deep-navy transition-colors">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Coba Lagi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
