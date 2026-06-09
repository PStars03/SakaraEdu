@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden bg-gradient-to-br from-soft-bg via-white to-sky-blue/10 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center animate-fade-up">
                <h1 class="font-heading text-4xl font-bold tracking-tight text-deep-navy sm:text-6xl">
                    Temukan Beasiswa, Ikuti Bootcamp, dan Kelola <span class="text-gradient font-extrabold">Dana Pendidikanmu</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-slate-text">
                    SakaraEdu membantu mahasiswa mencari peluang belajar, menemukan program pengembangan skill, dan mengatur dana beasiswa dengan lebih rapi dalam satu platform terpusat.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-xl bg-fresh-green px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-dark-green hover:px-10 hover:shadow-md hover:-translate-y-1 duration-300 transition-all">
                        Mulai Sekarang
                    </a>
                    <a href="{{ route('scholarships.index') }}" class="rounded-xl border-2 border-primary-blue px-8 py-3 text-sm font-semibold text-primary-blue hover:bg-primary-blue hover:text-white hover:px-10 hover:shadow-md hover:-translate-y-1 duration-300 transition-all">
                        Lihat Beasiswa <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Beasiswa Terbaru Section -->
    <div class="py-16 sm:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-12 animate-fade-up">
                <h2 class="text-3xl font-bold tracking-tight text-deep-navy sm:text-4xl">Beasiswa Terbaru</h2>
                <p class="mt-4 text-lg text-slate-500">Peluang beasiswa terkini untuk mendukung pendidikannmu.</p>
            </div>
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($scholarships as $scholarship)
                    <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 card-hover">
                        <div class="h-48 w-full bg-slate-100 overflow-hidden">
                            @if($scholarship->poster)
                                <img src="{{ Storage::url($scholarship->poster) }}" alt="{{ $scholarship->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-slate-100 text-slate-400">
                                    <svg class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-center gap-x-2 text-xs">
                                <span class="rounded-full bg-primary-blue/10 px-2.5 py-0.5 font-medium text-primary-blue">{{ $scholarship->organizer }}</span>
                            </div>
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-deep-navy line-clamp-2">
                                <a href="{{ route('scholarships.show', $scholarship->slug) }}"><span class="absolute inset-0"></span>{{ $scholarship->title }}</a>
                            </h3>
                            <div class="mt-4 flex items-center gap-x-2 text-sm text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                {{ $scholarship->location }}
                            </div>
                            <div class="mt-2 flex items-center gap-x-2 text-sm text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                s/d {{ \Carbon\Carbon::parse($scholarship->end_date)->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-slate-500">Belum ada beasiswa yang dipublikasikan.</div>
                @endforelse
            </div>
            
            <div class="mt-10 text-center">
                <a href="{{ route('scholarships.index') }}" class="text-sm font-semibold text-primary-blue hover:text-sky-blue">Lihat Semua Beasiswa →</a>
            </div>
        </div>
    </div>

    <!-- Bootcamp Terbaru Section -->
    <div class="py-16 sm:py-24 bg-soft-bg">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-12 animate-fade-up">
                <h2 class="text-3xl font-bold tracking-tight text-deep-navy sm:text-4xl">Bootcamp & Pelatihan</h2>
                <p class="mt-4 text-lg text-slate-500">Asah skill kamu dengan program bootcamp pilihan.</p>
            </div>
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($bootcamps as $bootcamp)
                    <div class="card-hover flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div>
                            @if($bootcamp->poster)
                                <img src="{{ Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-44 w-full rounded-xl object-cover">
                            @else
                                <div class="flex h-44 w-full items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                    <svg class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif

                            <div class="mt-4 flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-bold text-deep-navy line-clamp-2">{{ $bootcamp->title }}</h3>
                                    <p class="mt-1 text-sm text-slate-text">{{ $bootcamp->organizer }}</p>
                                </div>

                                @if ($bootcamp->is_paid)
                                    <span class="shrink-0 rounded-full bg-sky-blue/10 px-3 py-1 text-xs font-semibold text-primary-blue">
                                        Rp{{ number_format($bootcamp->price, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="shrink-0 rounded-full bg-fresh-green/10 px-3 py-1 text-xs font-semibold text-dark-green">
                                        Free
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 flex items-center gap-x-2 text-sm text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                {{ $bootcamp->location }}
                            </div>
                        </div>

                        <a href="{{ route('bootcamps.show', $bootcamp->slug) }}" class="mt-5 inline-flex w-full justify-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white transition hover:bg-deep-navy">
                            Lihat Detail
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-slate-500">Belum ada bootcamp yang dipublikasikan.</div>
                @endforelse
            </div>
            
            <div class="mt-10 text-center">
                <a href="{{ route('bootcamps.index') }}" class="text-sm font-semibold text-primary-blue hover:text-sky-blue">Lihat Semua Bootcamp →</a>
            </div>
        </div>
    </div>

    <!-- Berita Edukasi Section -->
    <div class="py-16 sm:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-12 animate-fade-up">
                <h2 class="text-3xl font-bold tracking-tight text-deep-navy sm:text-4xl">Berita Edukasi</h2>
                <p class="mt-4 text-lg text-slate-500">Update informasi terkini seputar dunia pendidikan.</p>
            </div>
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($news as $item)
                    <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 card-hover">
                        <div class="h-48 w-full bg-slate-100 overflow-hidden">
                            @if($item->thumbnail)
                                <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-slate-100 text-slate-400">
                                    <svg class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" /></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-center gap-x-4 text-xs">
                                <time datetime="{{ $item->created_at }}" class="text-slate-500">{{ $item->created_at->format('d M Y') }}</time>
                                <span class="relative z-10 rounded-full bg-slate-100 px-3 py-1.5 font-medium text-slate-600">{{ $item->category }}</span>
                            </div>
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-deep-navy line-clamp-2">
                                <a href="{{ route('news.show', $item->slug) }}"><span class="absolute inset-0"></span>{{ $item->title }}</a>
                            </h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-slate-500">Belum ada berita yang dipublikasikan.</div>
                @endforelse
            </div>
            
            <div class="mt-10 text-center">
                <a href="{{ route('news.index') }}" class="text-sm font-semibold text-primary-blue hover:text-sky-blue">Baca Berita Lainnya →</a>
            </div>
        </div>
    </div>
@endsection
