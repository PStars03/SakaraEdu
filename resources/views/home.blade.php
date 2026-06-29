@extends('layouts.app')

@section('title', 'SakaraEdu - Beasiswa, Bootcamp & Workshop Terbaik Indonesia')

@section('content')

{{-- ======= HERO SECTION ======= --}}
<div class="relative bg-deep-navy overflow-hidden" x-data="{
    current: 0,
    total: 3,
    auto: null,
    start() {
        this.auto = setInterval(() => { this.next() }, 5000)
    },
    next() { this.current = (this.current + 1) % this.total },
    prev() { this.current = (this.current - 1 + this.total) % this.total },
    go(i) { this.current = i }
}" x-init="start()">

    {{-- Slides --}}
    <div class="relative h-[420px] sm:h-[520px] overflow-hidden">
        {{-- Slide 1 --}}
        <div class="absolute inset-0 transition-opacity duration-700" :class="current === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0'">
            <img src="https://picsum.photos/seed/hero1/1600/700" class="w-full h-full object-cover opacity-30" alt="Hero 1">
            <div class="absolute inset-0 bg-gradient-to-r from-deep-navy via-deep-navy/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl animate-fade-up">
                        <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-fresh-green/20 text-fresh-green border border-fresh-green/30 mb-4">🎓 BEASISWA TERBUKA 2026</span>
                        <h1 class="text-4xl sm:text-5xl font-bold font-heading text-white leading-tight mb-4">
                            Wujudkan Mimpimu dengan <span class="text-sky-blue">Beasiswa Terbaik</span>
                        </h1>
                        <p class="text-lg text-slate-300 mb-8 max-w-xl">
                            Temukan ratusan program beasiswa S1, S2, S3 dalam dan luar negeri. Daftar gratis dan mulai perjalananmu hari ini.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('scholarships.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-blue px-6 py-3.5 font-bold text-white shadow-lg hover:bg-sky-blue transition-all hover:-translate-y-0.5">
                                Cari Beasiswa
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </a>
                            <a href="{{ route('bootcamps.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-white/10 px-6 py-3.5 font-bold text-white backdrop-blur-sm hover:bg-white/20 transition-all">
                                Lihat Bootcamp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="absolute inset-0 transition-opacity duration-700" :class="current === 1 ? 'opacity-100 z-10' : 'opacity-0 z-0'">
            <img src="https://picsum.photos/seed/hero2/1600/700" class="w-full h-full object-cover opacity-30" alt="Hero 2">
            <div class="absolute inset-0 bg-gradient-to-r from-deep-navy via-deep-navy/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl animate-fade-up">
                        <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-fresh-green/20 text-fresh-green border border-fresh-green/30 mb-4">🚀 BOOTCAMP INTENSIF</span>
                        <h1 class="text-4xl sm:text-5xl font-bold font-heading text-white leading-tight mb-4">
                            Kuasai Skill Digital dalam <span class="text-fresh-green">4 Minggu</span>
                        </h1>
                        <p class="text-lg text-slate-300 mb-8 max-w-xl">
                            Dari coding, UI/UX, data science hingga digital marketing. Bootcamp intensif bersama mentor praktisi industri terpercaya.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('bootcamps.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-fresh-green px-6 py-3.5 font-bold text-white shadow-lg hover:bg-dark-green transition-all hover:-translate-y-0.5">
                                Daftar Bootcamp
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="absolute inset-0 transition-opacity duration-700" :class="current === 2 ? 'opacity-100 z-10' : 'opacity-0 z-0'">
            <img src="https://picsum.photos/seed/hero3/1600/700" class="w-full h-full object-cover opacity-30" alt="Hero 3">
            <div class="absolute inset-0 bg-gradient-to-r from-deep-navy via-deep-navy/80 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl animate-fade-up">
                        <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-sky-blue/20 text-sky-blue border border-sky-blue/30 mb-4">🛠️ WORKSHOP & WEBINAR GRATIS</span>
                        <h1 class="text-4xl sm:text-5xl font-bold font-heading text-white leading-tight mb-4">
                            Belajar dari Praktisi <span class="text-sky-blue">Tanpa Biaya</span>
                        </h1>
                        <p class="text-lg text-slate-300 mb-8 max-w-xl">
                            Ratusan webinar dan workshop gratis dari para ahli industri siap membantumu naik level. Daftar sekarang sebelum penuh!
                        </p>
                        <a href="{{ route('bootcamps.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-sky-blue px-6 py-3.5 font-bold text-white shadow-lg hover:bg-primary-blue transition-all hover:-translate-y-0.5">
                            Lihat Workshop Gratis
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation Arrows --}}
        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 h-10 w-10 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm flex items-center justify-center text-white transition-all">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
        </button>
        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 h-10 w-10 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm flex items-center justify-center text-white transition-all">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            <template x-for="i in total" :key="i">
                <button @click="go(i-1)" :class="current === i-1 ? 'w-6 bg-white' : 'w-2 bg-white/40'" class="h-2 rounded-full transition-all duration-300"></button>
            </template>
        </div>
    </div>

    {{-- Stats Bar --}}
    <div class="border-t border-white/10 bg-white/5 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-white/10">
                <div class="py-4 px-6 text-center">
                    <div class="text-2xl font-bold text-white">{{ $scholarships->count() + 10 }}+</div>
                    <div class="text-xs text-slate-400 mt-0.5">Program Beasiswa</div>
                </div>
                <div class="py-4 px-6 text-center">
                    <div class="text-2xl font-bold text-white">{{ $bootcamps->count() + 5 }}+</div>
                    <div class="text-xs text-slate-400 mt-0.5">Bootcamp & Workshop</div>
                </div>
                <div class="py-4 px-6 text-center hidden sm:block">
                    <div class="text-2xl font-bold text-white">1.2K+</div>
                    <div class="text-xs text-slate-400 mt-0.5">Peserta Terdaftar</div>
                </div>
                <div class="py-4 px-6 text-center hidden sm:block">
                    <div class="text-2xl font-bold text-white">50+</div>
                    <div class="text-xs text-slate-400 mt-0.5">Mitra Penyelenggara</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ======= CATEGORY QUICK FILTER ======= --}}
<div class="bg-white border-b border-slate-100 sticky top-16 z-40 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex gap-3 overflow-x-auto no-scrollbar">
            <a href="#bootcamp-section" class="shrink-0 inline-flex items-center gap-2 rounded-full border border-primary-blue bg-primary-blue/5 px-5 py-2 text-sm font-semibold text-primary-blue hover:bg-primary-blue hover:text-white transition-all">
                🚀 Bootcamp
            </a>
            <a href="#workshop-section" class="shrink-0 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:border-primary-blue hover:text-primary-blue transition-all">
                🛠️ Workshop
            </a>
            <a href="#beasiswa-section" class="shrink-0 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:border-primary-blue hover:text-primary-blue transition-all">
                🎓 Beasiswa
            </a>
            <a href="{{ route('bootcamps.index') }}" class="shrink-0 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:border-primary-blue hover:text-primary-blue transition-all">
                📡 Webinar Gratis
            </a>
            <a href="{{ route('news.index') }}" class="shrink-0 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:border-primary-blue hover:text-primary-blue transition-all">
                📰 Artikel & Tips
            </a>
        </div>
    </div>
</div>

{{-- ======= MAIN CONTENT ======= --}}
<div class="bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 space-y-20">

        {{-- ===== BOOTCAMP SECTION ===== --}}
        <section id="bootcamp-section">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block h-1 w-6 rounded bg-primary-blue"></span>
                        <span class="text-xs font-bold text-primary-blue uppercase tracking-wider">Event & Program</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold font-heading text-deep-navy">Bootcamp & Workshop Pilihan</h2>
                </div>
                <a href="{{ route('bootcamps.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-bold text-primary-blue hover:text-sky-blue transition-colors">
                    Lihat Semua
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($bootcamps->take(6) as $idx => $bootcamp)
                    <div class="group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col animate-fade-up" style="animation-delay: {{ $idx * 80 }}ms">
                        {{-- Image --}}
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            @if($bootcamp->poster)
                                <img src="{{ Str::startsWith($bootcamp->poster, 'http') ? $bootcamp->poster : Storage::url($bootcamp->poster) }}"
                                     alt="{{ $bootcamp->title }}"
                                     class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex h-full items-center justify-center bg-gradient-to-br from-primary-blue/10 to-sky-blue/10 text-4xl">🚀</div>
                            @endif

                            {{-- Type Badge --}}
                            <div class="absolute top-3 left-3">
                                @php
                                    $typeLabel = match($bootcamp->type ?? 'bootcamp') {
                                        'workshop' => ['🛠️ Workshop', 'bg-orange-500'],
                                        'webinar'  => ['📡 Webinar', 'bg-purple-600'],
                                        default    => ['🚀 Bootcamp', 'bg-primary-blue'],
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-bold text-white {{ $typeLabel[1] }} shadow-md">
                                    {{ $typeLabel[0] }}
                                </span>
                            </div>

                            {{-- Price Badge --}}
                            <div class="absolute top-3 right-3">
                                @if($bootcamp->is_paid)
                                    <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-white shadow-md text-primary-blue">
                                        Rp{{ number_format($bootcamp->price, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-fresh-green shadow-md text-white">
                                        GRATIS
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex-1">
                                <h3 class="font-bold text-deep-navy line-clamp-2 leading-snug mb-2 group-hover:text-primary-blue transition-colors text-[15px]">
                                    {{ $bootcamp->title }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-3">{{ $bootcamp->description }}</p>
                            </div>

                            <div class="border-t border-slate-100 pt-3 mt-2 space-y-1.5">
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $bootcamp->start_date->format('d M Y') }}
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    {{ $bootcamp->location }}
                                </div>
                            </div>

                            <div class="flex items-center gap-2 mt-4">
                                <div class="h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 shrink-0">
                                    {{ substr($bootcamp->organizer, 0, 1) }}
                                </div>
                                <span class="text-xs text-slate-500 truncate font-medium">{{ $bootcamp->organizer }}</span>
                            </div>

                            <a href="{{ route('bootcamps.show', $bootcamp->slug) }}"
                               class="mt-4 w-full inline-flex justify-center items-center gap-2 rounded-xl py-2.5 text-sm font-bold transition-all
                                      {{ $bootcamp->is_paid ? 'bg-primary-blue text-white hover:bg-deep-navy' : 'bg-fresh-green/10 text-dark-green border border-fresh-green/30 hover:bg-fresh-green hover:text-white' }}">
                                {{ $bootcamp->is_paid ? 'Lihat Detail & Daftar' : 'Daftar Gratis' }}
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-400">Belum ada bootcamp tersedia.</div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('bootcamps.index') }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-primary-blue px-8 py-3 text-sm font-bold text-primary-blue hover:bg-primary-blue hover:text-white transition-all">
                    Lihat Semua Bootcamp & Workshop
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </section>

        {{-- ===== MID-PAGE CTA BANNER ===== --}}
        <section class="relative rounded-3xl bg-gradient-to-br from-primary-blue via-deep-navy to-sky-blue overflow-hidden py-14 px-8 text-center shadow-2xl">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-10 -right-10 w-60 h-60 rounded-full bg-white/20 blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-60 h-60 rounded-full bg-fresh-green/20 blur-3xl"></div>
            </div>
            <div class="relative">
                <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-white text-xs font-bold mb-4 border border-white/20">🎓 BEASISWA TERSEDIA SEKARANG</span>
                <h2 class="text-3xl sm:text-4xl font-bold font-heading text-white mb-4 max-w-2xl mx-auto leading-tight">
                    Sudah Tahu Beasiswa Impianmu?
                </h2>
                <p class="text-slate-300 text-base mb-8 max-w-xl mx-auto">
                    Jangan lewatkan deadline! Cari, pelajari, dan daftar beasiswa terbaik sesuai profil dan jurusanmu.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('scholarships.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-primary-blue shadow-lg hover:-translate-y-1 transition-all">
                        🔍 Cari Beasiswa Sekarang
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/10 px-7 py-3.5 text-sm font-bold text-white hover:bg-white/20 transition-all">
                            Daftar Akun Gratis
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        {{-- ===== BEASISWA SECTION ===== --}}
        <section id="beasiswa-section">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block h-1 w-6 rounded bg-sky-blue"></span>
                        <span class="text-xs font-bold text-sky-blue uppercase tracking-wider">Peluang Terbuka</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold font-heading text-deep-navy">Info Beasiswa Terkini</h2>
                </div>
                <a href="{{ route('scholarships.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-bold text-primary-blue hover:text-sky-blue transition-colors">
                    Lihat Semua
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($scholarships->take(6) as $idx => $scholarship)
                    <div class="group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col animate-fade-up" style="animation-delay: {{ $idx * 80 }}ms">
                        {{-- Image --}}
                        <div class="relative h-44 overflow-hidden bg-slate-100">
                            @if($scholarship->poster)
                                <img src="{{ Str::startsWith($scholarship->poster, 'http') ? $scholarship->poster : Storage::url($scholarship->poster) }}"
                                     alt="{{ $scholarship->title }}"
                                     class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex h-full items-center justify-center bg-gradient-to-br from-sky-blue/10 to-primary-blue/10 text-4xl">🎓</div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-sky-blue text-white shadow-md">Beasiswa</span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex-1">
                                <h3 class="font-bold text-deep-navy line-clamp-2 leading-snug mb-2 group-hover:text-primary-blue transition-colors text-[15px]">
                                    {{ $scholarship->title }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $scholarship->description }}</p>
                            </div>

                            <div class="border-t border-slate-100 pt-3 mt-3 space-y-2">
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="h-3.5 w-3.5 text-red-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-red-500 font-semibold">Deadline: {{ $scholarship->end_date->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    {{ $scholarship->location }}
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-600 font-semibold">
                                    <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    {{ $scholarship->organizer }}
                                </div>
                            </div>

                            <a href="{{ route('scholarships.show', $scholarship->slug) }}"
                               class="mt-4 w-full inline-flex justify-center items-center gap-2 rounded-xl bg-sky-blue/10 text-primary-blue border border-sky-blue/30 py-2.5 text-sm font-bold hover:bg-primary-blue hover:text-white hover:border-primary-blue transition-all">
                                Lihat Detail & Daftar
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-400">Belum ada beasiswa tersedia.</div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('scholarships.index') }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-sky-blue px-8 py-3 text-sm font-bold text-sky-blue hover:bg-sky-blue hover:text-white transition-all">
                    Lihat Semua Beasiswa
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </section>

        {{-- ===== ARTICLES SECTION ===== --}}
        @if($news->count() > 0)
        <section>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block h-1 w-6 rounded bg-fresh-green"></span>
                        <span class="text-xs font-bold text-fresh-green uppercase tracking-wider">Informasi & Tips</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold font-heading text-deep-navy">Artikel & Berita Terbaru</h2>
                </div>
                <a href="{{ route('news.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-bold text-primary-blue hover:text-sky-blue transition-colors">
                    Lihat Semua
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Featured Article (big card) --}}
                @if($news->count() >= 1)
                @php $featuredNews = $news->first(); @endphp
                <div class="md:col-span-1 group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col animate-fade-up">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        @if($featuredNews->thumbnail)
                            <img src="{{ Str::startsWith($featuredNews->thumbnail, 'http') ? $featuredNews->thumbnail : Storage::url($featuredNews->thumbnail) }}"
                                 alt="{{ $featuredNews->title }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-fresh-green text-white shadow-md">{{ $featuredNews->category }}</span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="font-bold text-deep-navy line-clamp-2 group-hover:text-primary-blue transition-colors mb-3 leading-snug">{{ $featuredNews->title }}</h3>
                        <p class="text-sm text-slate-500 line-clamp-3 flex-1">{{ Str::limit(strip_tags($featuredNews->content), 120) }}</p>
                        <a href="{{ route('news.show', $featuredNews->slug) }}" class="mt-4 text-sm font-bold text-primary-blue hover:text-sky-blue transition-colors flex items-center gap-1">
                            Baca Selengkapnya <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    </div>
                </div>
                @endif

                {{-- Other Articles list --}}
                <div class="md:col-span-2 flex flex-col gap-4">
                    @foreach($news->skip(1)->take(4) as $idx => $article)
                        <a href="{{ route('news.show', $article->slug) }}" class="group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex gap-4 p-4 animate-fade-up" style="animation-delay: {{ ($idx+1) * 80 }}ms">
                            <div class="shrink-0 w-24 h-20 rounded-xl overflow-hidden bg-slate-100">
                                @if($article->thumbnail)
                                    <img src="{{ Str::startsWith($article->thumbnail, 'http') ? $article->thumbnail : Storage::url($article->thumbnail) }}"
                                         alt="{{ $article->title }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-xs font-bold text-primary-blue">{{ $article->category }}</span>
                                <h4 class="font-bold text-sm text-deep-navy line-clamp-2 mt-1 leading-snug group-hover:text-primary-blue transition-colors">{{ $article->title }}</h4>
                                <p class="text-xs text-slate-400 mt-1">{{ $article->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== FEATURED PARTNERS ===== --}}
        <section class="text-center">
            <p class="text-sm text-slate-400 font-semibold uppercase tracking-wider mb-8">Bekerja sama dengan penyelenggara terpercaya</p>
            <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                @foreach(['Kemendikbud', 'LPDP', 'Google', 'Erasmus+', 'Sampoerna', 'Djarum', 'BRIN', 'Bank Indonesia'] as $partner)
                    <span class="text-slate-500 font-bold text-sm bg-white rounded-xl px-5 py-2.5 shadow-sm border border-slate-200">{{ $partner }}</span>
                @endforeach
            </div>
        </section>

    </div>
</div>

@endsection
