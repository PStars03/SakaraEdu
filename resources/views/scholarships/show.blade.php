@extends('layouts.app')

@section('title', $scholarship->title . ' - SakaraEdu')

@section('content')
<div class="bg-gradient-to-b from-soft-bg to-white py-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('scholarships.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar Beasiswa
            </a>
        </div>
        
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200 animate-fade-up">
            @if($scholarship->poster)
                <div class="aspect-video w-full overflow-hidden bg-slate-50 relative group">
                    <img src="{{ Storage::url($scholarship->poster) }}" alt="{{ $scholarship->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            @endif
            
            <div class="p-8 sm:p-12">
                <div class="flex flex-wrap items-center gap-4 text-xs mb-6">
                    <span class="inline-flex items-center rounded-full bg-primary-blue/10 px-3 py-1 font-semibold text-primary-blue ring-1 ring-inset ring-primary-blue/20">{{ $scholarship->organizer }}</span>
                    <span class="inline-flex items-center text-slate-500 bg-slate-50 px-3 py-1 rounded-full ring-1 ring-inset ring-slate-200">
                        <svg class="mr-1.5 h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        Tutup: {{ $scholarship->end_date->format('d F Y') }}
                    </span>
                </div>
                
                <h1 class="mb-8 font-heading text-3xl font-bold leading-tight text-deep-navy sm:text-4xl">{{ $scholarship->title }}</h1>
                
                <div class="prose prose-slate max-w-none text-slate-600 prose-headings:font-heading prose-headings:text-deep-navy prose-a:text-primary-blue hover:prose-a:text-sky-blue">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Deskripsi
                    </h3>
                    <p class="whitespace-pre-line text-justify leading-relaxed">{{ $scholarship->description }}</p>
                    
                    <div class="mt-10 mb-10 h-px bg-slate-100 w-full"></div>
                    
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Persyaratan
                    </h3>
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <p class="whitespace-pre-line leading-relaxed m-0">{{ $scholarship->requirements }}</p>
                    </div>
                    
                    @if($scholarship->benefits)
                        <div class="mt-10 mb-10 h-px bg-slate-100 w-full"></div>
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <svg class="h-5 w-5 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                            Manfaat & Keuntungan
                        </h3>
                        <p class="whitespace-pre-line leading-relaxed">{{ $scholarship->benefits }}</p>
                    @endif
                </div>
                
                <div class="mt-12 pt-8 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="flex items-center gap-2 text-sm font-medium text-slate-600 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                        <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $scholarship->location }}
                    </div>
                    
                    <a href="{{ $scholarship->registration_link }}" target="_blank" class="inline-flex justify-center items-center gap-2 rounded-xl bg-primary-blue px-8 py-3.5 text-sm font-semibold text-white shadow-md hover:bg-deep-navy hover:-translate-y-1 transition-all btn-transition">
                        Daftar Beasiswa Sekarang
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
