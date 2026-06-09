@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow-sm border border-slate-100">
        <h2 class="font-heading text-2xl font-bold text-deep-navy">Selamat Datang, Admin {{ auth()->user()->name }}! 👋</h2>
        <p class="mt-2 text-slate-text">Dari dashboard ini Anda dapat mengelola beasiswa, bootcamp, dan berita.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <!-- Placeholder Cards for future features -->
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="rounded-xl bg-primary-blue/10 p-4">
                <svg class="h-6 w-6 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Beasiswa</p>
                <p class="text-2xl font-bold text-deep-navy">{{ $scholarshipCount }}</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="rounded-xl bg-fresh-green/10 p-4">
                <svg class="h-6 w-6 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Bootcamp</p>
                <p class="text-2xl font-bold text-deep-navy">{{ $bootcampCount }}</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="rounded-xl bg-sky-blue/10 p-4">
                <svg class="h-6 w-6 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Berita</p>
                <p class="text-2xl font-bold text-deep-navy">{{ $newsCount }}</p>
            </div>
        </div>
    </div>
@endsection
