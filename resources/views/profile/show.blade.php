@extends('layouts.dashboard')

@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-up">

    @if(session('success'))
        <div class="rounded-xl bg-fresh-green/10 border border-fresh-green/30 px-4 py-3 text-sm font-medium text-dark-green flex items-center gap-2">
            <svg class="h-5 w-5 text-fresh-green shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Card --}}
    <div class="rounded-2xl bg-white border border-slate-100 shadow-sm overflow-hidden">
        {{-- Cover --}}
        <div class="h-28 bg-gradient-to-r from-primary-blue via-sky-blue to-fresh-green"></div>

        {{-- Avatar + Name --}}
        <div class="px-8 pb-6 -mt-12">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->name }}"
                            class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-md">
                    @else
                        <div class="h-24 w-24 rounded-full bg-primary-blue border-4 border-white shadow-md flex items-center justify-center">
                            <span class="text-3xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-primary-blue px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-all hover:-translate-y-0.5">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Profil
                </a>
            </div>
            <div class="mt-4">
                <h2 class="text-2xl font-bold text-deep-navy font-heading">{{ $user->name }}</h2>
                <p class="text-slate-500 text-sm mt-0.5">{{ $user->email }}</p>
                <span class="mt-2 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    {{ $user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'admin' ? 'bg-blue-100 text-primary-blue' : 'bg-green-100 text-dark-green') }}">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Info Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        {{-- Kontak --}}
        <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6">
            <h3 class="font-heading font-bold text-deep-navy mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Informasi Kontak
            </h3>
            <dl class="space-y-3 text-sm">
                <div>
                    <dt class="text-xs font-medium text-slate-400 uppercase tracking-wider">No. HP</dt>
                    <dd class="mt-0.5 font-medium text-slate-700">{{ $user->phone ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-slate-400 uppercase tracking-wider">Domisili / Alamat</dt>
                    <dd class="mt-0.5 font-medium text-slate-700">{{ $user->address ?? '—' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Akademik --}}
        <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6">
            <h3 class="font-heading font-bold text-deep-navy mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                Informasi Akademik
            </h3>
            <dl class="space-y-3 text-sm">
                <div>
                    <dt class="text-xs font-medium text-slate-400 uppercase tracking-wider">Kampus</dt>
                    <dd class="mt-0.5 font-medium text-slate-700">{{ $user->campus ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-slate-400 uppercase tracking-wider">Program Studi</dt>
                    <dd class="mt-0.5 font-medium text-slate-700">{{ $user->study_program ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-slate-400 uppercase tracking-wider">Semester</dt>
                    <dd class="mt-0.5 font-medium text-slate-700">{{ $user->semester ? 'Semester ' . $user->semester : '—' }}</dd>
                </div>
            </dl>
        </div>
    </div>

</div>
@endsection
