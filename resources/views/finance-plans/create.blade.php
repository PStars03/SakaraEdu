@extends('layouts.dashboard')

@section('title', 'Buat Rencana Keuangan')
@section('header', 'Buat Rencana Keuangan Baru')

@section('content')
    <div class="mb-4">
        <a href="{{ route('uang-beasiswa.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Daftar Rencana</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <p class="mb-8 text-slate-600">Gunakan kalkulator di bawah ini untuk merencanakan alokasi uang beasiswa Anda secara proporsional sesuai dengan kebutuhan bulanan/semesteran.</p>
        
        <livewire:finance-plan-calculator />
    </div>
@endsection
