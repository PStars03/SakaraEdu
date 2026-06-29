@extends('layouts.app')

@section('title', $bootcamp->title . ' - SakaraEdu')

@section('content')
<!-- Hero Banner -->
<div class="w-full bg-slate-900 border-b border-slate-200">
    <div class="mx-auto max-w-7xl">
        <div class="h-[200px] sm:h-[350px] w-full relative overflow-hidden bg-slate-100">
            @if($bootcamp->poster)
                <img src="{{ Str::startsWith($bootcamp->poster, 'http') ? $bootcamp->poster : Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-full w-full object-cover blur-sm opacity-50 absolute inset-0">
                <img src="{{ Str::startsWith($bootcamp->poster, 'http') ? $bootcamp->poster : Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-full w-auto max-w-full mx-auto relative z-10 object-contain shadow-2xl">
            @else
                <div class="flex h-full w-full items-center justify-center text-slate-300">
                    <svg class="h-20 w-20 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586..."></path></svg>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="bg-slate-50 min-h-screen pb-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        <div class="mb-6">
            <a href="{{ route('bootcamps.index') }}" class="inline-flex items-center text-sm font-semibold text-primary-blue hover:text-sky-blue transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar Bootcamp
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Left Column: Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 animate-fade-up">
                    <h1 class="font-heading text-3xl font-bold leading-tight text-deep-navy sm:text-4xl mb-4">{{ $bootcamp->title }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-6 mt-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200">
                                <span class="font-bold text-slate-500">{{ substr($bootcamp->organizer, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Diselenggarakan oleh</p>
                                <p class="text-sm font-bold text-deep-navy">{{ $bootcamp->organizer }}</p>
                            </div>
                        </div>
                        
                        <div class="hidden sm:block h-10 w-px bg-slate-200"></div>
                        
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary-blue">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Tanggal Pelaksanaan</p>
                                <p class="text-sm font-bold text-deep-navy">{{ $bootcamp->start_date->format('d M Y') }} - {{ $bootcamp->end_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 animate-fade-up" style="animation-delay: 100ms;">
                    <div class="prose prose-slate max-w-none text-slate-600 prose-headings:font-heading prose-headings:text-deep-navy prose-a:text-primary-blue">
                        <h3 class="text-xl font-bold mb-4 border-b border-slate-100 pb-4">Deskripsi Bootcamp</h3>
                        <p class="whitespace-pre-line text-justify leading-relaxed">{{ $bootcamp->description }}</p>
                        
                        @if($bootcamp->requirements)
                            <h3 class="text-xl font-bold mt-10 mb-4 border-b border-slate-100 pb-4">Syarat & Ketentuan</h3>
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <p class="whitespace-pre-line leading-relaxed m-0 text-sm">{{ $bootcamp->requirements }}</p>
                            </div>
                        @endif
                        
                        @if($bootcamp->curriculum)
                            <h3 class="text-xl font-bold mt-10 mb-4 border-b border-slate-100 pb-4">Kurikulum & Silabus</h3>
                            <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                                <p class="whitespace-pre-line leading-relaxed m-0 text-sm">{{ $bootcamp->curriculum }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Sticky Checkout Box (Loket Style) -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden animate-fade-up" style="animation-delay: 200ms;">
                    <!-- Header -->
                    <div class="bg-slate-50 p-5 border-b border-slate-200 flex items-center justify-center">
                        <span class="font-bold text-deep-navy">Informasi Pendaftaran</span>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <div class="mb-6 pb-6 border-b border-slate-100">
                            <p class="text-sm text-slate-500 mb-1 font-medium">Lokasi Pelaksanaan:</p>
                            <div class="flex items-start gap-2 text-deep-navy font-bold">
                                <svg class="h-5 w-5 text-primary-blue shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $bootcamp->location }}</span>
                            </div>
                        </div>

                        <!-- Ticket Item -->
                        <div class="mb-6 rounded-xl border border-primary-blue/20 bg-blue-50/30 p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-bold text-deep-navy text-sm">Tiket Reguler</h4>
                                    <p class="text-xs text-slate-500">Akses seluruh materi</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                @if(!$bootcamp->is_paid)
                                    <span class="text-lg font-bold text-dark-green">Gratis</span>
                                @else
                                    <span class="text-lg font-bold text-primary-blue">Rp{{ number_format($bootcamp->price, 0, ',', '.') }}</span>
                                @endif
                                
                                <!-- Fake quantity selector for UI purposes -->
                                <div class="flex items-center gap-3 bg-white rounded-lg border border-slate-200 px-2 py-1">
                                    <button class="text-slate-400 hover:text-primary-blue">-</button>
                                    <span class="text-sm font-bold w-4 text-center">1</span>
                                    <button class="text-slate-400 hover:text-primary-blue">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center mb-6 pt-4 border-t border-slate-100">
                            <span class="font-bold text-slate-600">Total Pembayaran</span>
                            @if(!$bootcamp->is_paid)
                                <span class="text-xl font-black text-dark-green">Rp0</span>
                            @else
                                <span class="text-xl font-black text-deep-navy">Rp{{ number_format($bootcamp->price, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <!-- Action Button -->
                        @php
                            $daysLeft = now()->startOfDay()->diffInDays($bootcamp->end_date->startOfDay(), false);
                        @endphp
                        @if($daysLeft >= 0 && $daysLeft <= 7)
                            <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-2.5 flex items-center gap-2">
                                <span class="text-sm font-bold text-red-600">⏰ Sisa {{ $daysLeft }} hari lagi!</span>
                            </div>
                        @elseif($daysLeft >= 0 && $daysLeft <= 14)
                            <div class="mb-4 rounded-xl bg-amber-50 border border-amber-200 px-4 py-2.5 flex items-center gap-2">
                                <span class="text-sm font-bold text-amber-600">⚡ Sisa {{ $daysLeft }} hari</span>
                            </div>
                        @endif

                        @if($bootcamp->is_paid)
                        <a href="{{ route('bootcamps.checkout', $bootcamp->slug) }}" class="w-full flex justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-primary-blue to-sky-blue px-8 py-4 text-sm font-bold text-white shadow-lg hover:-translate-y-1 transition-all btn-transition">
                            💳 Beli Tiket Sekarang
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </a>
                        @else
                        <a href="{{ $bootcamp->registration_link }}" target="_blank" class="w-full flex justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-fresh-green to-dark-green px-8 py-4 text-sm font-bold text-white shadow-lg hover:-translate-y-1 transition-all btn-transition">
                            🎉 Daftar Gratis Sekarang
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </a>
                        @endif

                        <!-- Bookmark Button -->
                        @auth
                            @php $isBookmarked = auth()->user()->hasBookmarked(\App\Models\Bootcamp::class, $bootcamp->id); @endphp
                            <form action="{{ route('bookmarks.toggle') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="type" value="bootcamp">
                                <input type="hidden" name="id" value="{{ $bootcamp->id }}">
                                <button type="submit"
                                    class="w-full flex justify-center items-center gap-2 rounded-xl border-2 px-8 py-3 text-sm font-semibold transition-all
                                    {{ $isBookmarked ? 'border-primary-blue bg-primary-blue/10 text-primary-blue' : 'border-slate-300 text-slate-600 hover:border-primary-blue hover:text-primary-blue' }}">
                                    <svg class="h-4 w-4" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                    {{ $isBookmarked ? 'Tersimpan' : 'Simpan ke Favorit' }}
                                </button>
                            </form>
                        @endauth
                        
                        <p class="text-center text-xs text-slate-400 mt-4">
                            Kamu akan diarahkan ke halaman pendaftaran eksternal.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
