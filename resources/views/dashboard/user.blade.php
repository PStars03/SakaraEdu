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
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="rounded-xl bg-primary-blue/10 p-4">
                <svg class="h-6 w-6 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Beasiswa Tersimpan</p>
                <p class="text-2xl font-bold text-deep-navy">0</p>
            </div>
        </div>

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
                <p class="text-2xl font-bold text-deep-navy">0</p>
            </div>
        </div>
    </div>
@endsection
