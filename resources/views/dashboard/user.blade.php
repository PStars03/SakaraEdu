@extends('layouts.dashboard')

@section('title', 'Dashboard User')
@section('header', 'Dashboard User')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow-sm border border-slate-100">
        <h2 class="font-heading text-2xl font-bold text-deep-navy">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
        <p class="mt-2 text-slate-text">Ini adalah dashboard khusus mahasiswa. Kamu bisa mulai mencari beasiswa, mendaftar bootcamp, atau menghitung dana beasiswamu.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <!-- Placeholder Cards for future features -->
        <!-- Bookmark Card -->
        <a href="{{ route('bookmarks.index') }}" class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-primary-blue hover:shadow-md transition-all group">
            <div class="rounded-xl bg-primary-blue/10 p-4 group-hover:bg-primary-blue/20 transition-colors">
                <svg class="h-6 w-6 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Bookmark Tersimpan</p>
                <p class="text-2xl font-bold text-deep-navy">{{ $bookmarkCount }}</p>
            </div>
        </a>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="rounded-xl bg-fresh-green/10 p-4">
                <svg class="h-6 w-6 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Bootcamp Diikuti</p>
                <p class="text-2xl font-bold text-deep-navy">0</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="rounded-xl bg-sky-blue/10 p-4">
                <svg class="h-6 w-6 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Rencana Dana</p>
                <p class="text-2xl font-bold text-deep-navy">{{ $financePlanCount }}</p>
            </div>
        </div>
    </div>
@endsection
