@extends('layouts.app')

@section('title', 'Bootcamp, Workshop & Webinar - SakaraEdu')

@section('content')

{{-- Page Hero --}}
<div class="bg-gradient-to-br from-deep-navy via-primary-blue to-sky-blue py-14 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 right-0 w-96 h-96 rounded-full bg-white/30 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full bg-fresh-green/30 blur-3xl"></div>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold mb-4">🚀 PROGRAM TERPILIH</span>
        <h1 class="text-3xl sm:text-4xl font-bold font-heading text-white mb-3">Bootcamp, Workshop & Webinar</h1>
        <p class="text-slate-300 text-base max-w-xl mx-auto">Kembangkan skill profesionalmu bersama mentor terbaik dari industri terkemuka Indonesia</p>
    </div>
</div>

{{-- Content --}}
<div class="bg-slate-50 min-h-screen py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <livewire:public-bootcamp-list />
        </div>
    </div>
</div>
@endsection
