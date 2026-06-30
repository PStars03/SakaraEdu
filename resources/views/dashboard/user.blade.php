@extends('layouts.dashboard')

@section('title', 'Dashboard User')
@section('header', 'Dashboard User')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-green-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <div class="mb-8 rounded-2xl bg-white p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row gap-6 items-center justify-between">
        <div>
            <h2 class="font-heading text-2xl font-bold text-deep-navy">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
            <p class="mt-2 text-slate-text">Kelola keuangan semestermu dan temukan beasiswa yang tepat di SakaraEdu.</p>
        </div>
    </div>

    <!-- QuickLog AI & Financial Summary -->
    <div class="grid gap-6 md:grid-cols-3 mb-8">
        
        <!-- QuickLog Input (Span 2 cols) -->
        <div class="md:col-span-2 rounded-2xl bg-gradient-to-br from-primary-blue to-deep-navy p-6 shadow-md text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="h-6 w-6 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="text-lg font-bold">Sakara QuickLog AI</h3>
                </div>
                <p class="text-sm text-blue-100 mb-4">Catat pengeluaran & pemasukan hanya dengan mengetik kalimat biasa. AI akan memprosesnya untukmu.</p>
                
                <form action="{{ route('quicklog.store') }}" method="POST" class="relative">
                    @csrf
                    <input type="text" name="prompt" required autocomplete="off"
                           placeholder="Contoh: Beli makan siang 20rb dan bensin 15rb..." 
                           class="w-full rounded-xl border-0 bg-white/10 px-4 py-3 text-white placeholder-blue-200 backdrop-blur-sm focus:bg-white/20 focus:ring-2 focus:ring-sky-blue transition-all">
                    <button type="submit" class="absolute right-2 top-2 bottom-2 rounded-lg bg-sky-blue px-4 text-sm font-semibold text-white hover:bg-white hover:text-primary-blue transition-colors">
                        Catat
                    </button>
                </form>
            </div>
        </div>

        <!-- Financial Summary Card -->
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex flex-col justify-center">
            <h3 class="text-sm font-semibold text-slate-500 mb-4">Ringkasan Saldo</h3>
            <div class="mb-4">
                <p class="text-3xl font-bold {{ $saldo >= 0 ? 'text-fresh-green' : 'text-red-500' }}">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </p>
            </div>
            <div class="flex justify-between text-sm">
                <div>
                    <span class="text-slate-400 block text-xs">Pemasukan</span>
                    <span class="font-semibold text-deep-navy">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                </div>
                <div class="text-right">
                    <span class="text-slate-400 block text-xs">Pengeluaran</span>
                    <span class="font-semibold text-red-500">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions & Links -->
    <div class="grid gap-6 md:grid-cols-3">
        
        <!-- Recent Transactions -->
        <div class="md:col-span-2 rounded-2xl bg-white shadow-sm border border-slate-100 overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-semibold text-deep-navy">Transaksi Terbaru</h3>
                <a href="{{ route('transactions.index') }}" class="text-xs font-semibold text-primary-blue hover:text-deep-navy transition-colors">Lihat Semua →</a>
            </div>
            <div class="p-0">
                @if($recentTransactions->count() > 0)
                    <div class="divide-y divide-slate-100">
                        @foreach($recentTransactions as $tx)
                            <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="rounded-full p-2 {{ $tx->transaction_type === 'masuk' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        @if($tx->transaction_type === 'masuk')
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                        @else
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $tx->category }}</p>
                                        <p class="text-xs text-slate-400">{{ $tx->created_at->format('d M Y, H:i') }} &bull; {{ Str::limit($tx->description, 30) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold {{ $tx->transaction_type === 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $tx->transaction_type === 'masuk' ? '+' : '-' }}Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-3">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <p class="text-slate-500 text-sm">Belum ada transaksi. Gunakan QuickLog AI di atas untuk mencatat!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Shortcut Links -->
        <div class="space-y-4">
            <a href="{{ route('ai-advisor.index') }}" class="rounded-2xl bg-white p-5 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-sky-blue hover:shadow-md transition-all group">
                <div class="rounded-xl bg-sky-blue/10 p-3 group-hover:bg-sky-blue/20 transition-colors">
                    <svg class="h-5 w-5 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-deep-navy">AI Financial Advisor</p>
                    <p class="text-xs text-slate-400">{{ $aiPlannerCount }} Analisis Tersimpan</p>
                </div>
            </a>

            <a href="{{ route('bookmarks.index') }}" class="rounded-2xl bg-white p-5 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-primary-blue hover:shadow-md transition-all group">
                <div class="rounded-xl bg-primary-blue/10 p-3 group-hover:bg-primary-blue/20 transition-colors">
                    <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-deep-navy">Bookmark Tersimpan</p>
                    <p class="text-xs text-slate-400">{{ $bookmarkCount }} Item</p>
                </div>
            </a>
            
            <a href="{{ route('uang-beasiswa.index') }}" class="rounded-2xl bg-white p-5 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-fresh-green hover:shadow-md transition-all group">
                <div class="rounded-xl bg-fresh-green/10 p-3 group-hover:bg-fresh-green/20 transition-colors">
                    <svg class="h-5 w-5 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-deep-navy">Rencana Keuangan Beasiswa</p>
                    <p class="text-xs text-slate-400">Atur & Kalkulasi</p>
                </div>
            </a>
        </div>
    </div>
@endsection
