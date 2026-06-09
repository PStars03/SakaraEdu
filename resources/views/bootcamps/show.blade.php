@extends('layouts.app')

@section('title', $bootcamp->title . ' - SakaraEdu')

@section('content')
<div class="bg-soft-bg py-8">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('bootcamps.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Daftar Bootcamp</a>
        </div>
        
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200 animate-fade-up relative">
            
            <!-- Price Badge -->
            <div class="absolute top-6 right-6 z-10">
                @if(!$bootcamp->is_paid)
                    <span class="inline-flex items-center rounded-full bg-fresh-green px-4 py-2 text-sm font-bold text-white shadow-lg">
                        Free Bootcamp
                    </span>
                @else
                    <span class="inline-flex items-center rounded-full bg-sky-blue px-4 py-2 text-sm font-bold text-white shadow-lg">
                        {{ $bootcamp->formatted_price }}
                    </span>
                @endif
            </div>

            @if($bootcamp->poster)
                <div class="aspect-video w-full overflow-hidden bg-slate-100">
                    <img src="{{ Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-full w-full object-cover">
                </div>
            @endif
            
            <div class="p-8 sm:p-12">
                <div class="flex items-center gap-x-4 text-xs mb-4">
                    <span class="rounded-full bg-fresh-green/10 px-3 py-1 font-medium text-dark-green">{{ $bootcamp->organizer }}</span>
                    <span class="text-slate-500">Mulai: {{ $bootcamp->start_date->format('d F Y') }}</span>
                </div>
                
                <h1 class="mb-6 font-heading text-3xl font-bold text-deep-navy sm:text-4xl pr-20">{{ $bootcamp->title }}</h1>
                
                <div class="prose prose-slate max-w-none text-slate-600">
                    <h3 class="text-xl font-bold text-deep-navy mb-3">Deskripsi</h3>
                    <p class="whitespace-pre-line">{{ $bootcamp->description }}</p>
                    
                    @if($bootcamp->requirements)
                        <h3 class="text-xl font-bold text-deep-navy mt-8 mb-3">Persyaratan</h3>
                        <p class="whitespace-pre-line">{{ $bootcamp->requirements }}</p>
                    @endif
                    
                    @if($bootcamp->curriculum)
                        <h3 class="text-xl font-bold text-deep-navy mt-8 mb-3">Kurikulum / Silabus</h3>
                        <p class="whitespace-pre-line">{{ $bootcamp->curriculum }}</p>
                    @endif
                </div>
                
                <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-slate-600">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Lokasi: {{ $bootcamp->location }}
                    </div>
                    
                    <a href="{{ $bootcamp->registration_link }}" target="_blank" class="inline-flex justify-center rounded-xl bg-fresh-green px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-dark-green transition-colors btn-transition text-center">
                        Daftar Bootcamp Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
