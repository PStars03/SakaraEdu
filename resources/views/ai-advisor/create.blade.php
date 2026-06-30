@extends('layouts.dashboard')

@section('title', 'Analisis AI Baru')
@section('header', 'AI Student Financial Advisor')

@section('content')
    <div class="mb-6">
        <a href="{{ route('ai-advisor.index') }}"
           class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">
            ← Kembali ke Riwayat
        </a>
    </div>

    {{-- Info Banner --}}
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-sky-blue/10 to-primary-blue/10 border border-primary-blue/20 p-5">
        <div class="flex items-start gap-4">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-primary-blue text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-deep-navy">Bagaimana cara kerjanya?</h3>
                <p class="mt-1 text-sm text-slate-600">
                    Isi data keuangan Anda di bawah ini. Sistem akan menghitung total kebutuhan semester,
                    lalu AI SakaraEdu akan memberikan analisis dan saran yang personal untuk jurusan Anda.
                </p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 p-4 border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-700">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <h2 class="text-lg font-bold text-deep-navy mb-6 pb-4 border-b border-slate-100">
            Isi Data Keuangan Semester
        </h2>

        <livewire:ai-advisor-form />
    </div>
@endsection
