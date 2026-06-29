@extends('layouts.dashboard')

@section('title', 'Bookmark Saya')
@section('header', 'Bookmark Saya')

@section('content')
<div class="space-y-8 animate-fade-up">

    @if(session('success'))
        <div class="rounded-xl bg-fresh-green/10 border border-fresh-green/30 px-4 py-3 text-sm font-medium text-dark-green flex items-center gap-2">
            <svg class="h-5 w-5 text-fresh-green shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Beasiswa Tersimpan --}}
    <div>
        <div class="flex items-center gap-3 mb-5">
            <div class="h-9 w-9 rounded-xl bg-primary-blue/10 flex items-center justify-center">
                <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <h2 class="font-heading text-xl font-bold text-deep-navy">Beasiswa Tersimpan</h2>
            <span class="ml-auto text-sm font-medium text-slate-500">{{ $scholarshipBookmarks->count() }} item</span>
        </div>

        @if($scholarshipBookmarks->isEmpty())
            <div class="rounded-2xl border-2 border-dashed border-slate-200 p-10 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                <p class="mt-3 text-sm font-medium text-slate-500">Belum ada beasiswa yang disimpan</p>
                <a href="{{ route('scholarships.index') }}" class="mt-3 inline-flex items-center text-sm font-semibold text-primary-blue hover:text-sky-blue transition-colors">
                    Jelajahi Beasiswa →
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($scholarshipBookmarks as $bookmark)
                    @php $item = $bookmark->bookmarkable; @endphp
                    <div class="card-hover flex flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        @if($item->poster)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($item->poster) }}" alt="{{ $item->title }}" class="h-36 w-full rounded-xl object-cover mb-4">
                        @else
                            <div class="flex h-36 w-full items-center justify-center rounded-xl bg-blue-50 mb-4">
                                <svg class="h-10 w-10 text-primary-blue/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-bold text-deep-navy line-clamp-2">{{ $item->title }}</h3>
                            <p class="mt-1 text-xs text-slate-500">{{ $item->organizer }}</p>
                            <p class="mt-1.5 text-xs text-slate-400">Deadline: {{ $item->end_date->format('d M Y') }}</p>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('scholarships.show', $item->slug) }}" class="flex-1 text-center rounded-xl border border-primary-blue px-3 py-2 text-xs font-semibold text-primary-blue hover:bg-primary-blue hover:text-white transition-all">Lihat Detail</a>
                            <form action="{{ route('bookmarks.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="scholarship">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="rounded-xl border border-red-300 bg-red-50 px-3 py-2 text-xs font-semibold text-red-500 hover:bg-red-100 transition-colors" title="Hapus bookmark">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Bootcamp Tersimpan --}}
    <div>
        <div class="flex items-center gap-3 mb-5">
            <div class="h-9 w-9 rounded-xl bg-fresh-green/10 flex items-center justify-center">
                <svg class="h-5 w-5 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <h2 class="font-heading text-xl font-bold text-deep-navy">Bootcamp Tersimpan</h2>
            <span class="ml-auto text-sm font-medium text-slate-500">{{ $bootcampBookmarks->count() }} item</span>
        </div>

        @if($bootcampBookmarks->isEmpty())
            <div class="rounded-2xl border-2 border-dashed border-slate-200 p-10 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                <p class="mt-3 text-sm font-medium text-slate-500">Belum ada bootcamp yang disimpan</p>
                <a href="{{ route('bootcamps.index') }}" class="mt-3 inline-flex items-center text-sm font-semibold text-primary-blue hover:text-sky-blue transition-colors">
                    Jelajahi Bootcamp →
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($bootcampBookmarks as $bookmark)
                    @php $item = $bookmark->bookmarkable; @endphp
                    <div class="card-hover flex flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        @if($item->poster)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($item->poster) }}" alt="{{ $item->title }}" class="h-36 w-full rounded-xl object-cover mb-4">
                        @else
                            <div class="flex h-36 w-full items-center justify-center rounded-xl bg-green-50 mb-4">
                                <svg class="h-10 w-10 text-fresh-green/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                @if($item->is_paid)
                                    <span class="inline-flex items-center rounded-full bg-sky-blue/10 px-2 py-0.5 text-xs font-semibold text-primary-blue">{{ $item->formatted_price }}</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-fresh-green/10 px-2 py-0.5 text-xs font-semibold text-dark-green">Free</span>
                                @endif
                            </div>
                            <h3 class="font-bold text-deep-navy line-clamp-2">{{ $item->title }}</h3>
                            <p class="mt-1 text-xs text-slate-500">{{ $item->organizer }}</p>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('bootcamps.show', $item->slug) }}" class="flex-1 text-center rounded-xl border border-primary-blue px-3 py-2 text-xs font-semibold text-primary-blue hover:bg-primary-blue hover:text-white transition-all">Lihat Detail</a>
                            <form action="{{ route('bookmarks.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="bootcamp">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="rounded-xl border border-red-300 bg-red-50 px-3 py-2 text-xs font-semibold text-red-500 hover:bg-red-100 transition-colors" title="Hapus bookmark">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
