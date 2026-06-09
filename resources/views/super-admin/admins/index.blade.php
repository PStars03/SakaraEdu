@extends('layouts.dashboard')

@section('title', 'Manajemen Admin')
@section('header', 'Kelola Admin')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-200 animate-fade-up">
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-slate-500">Kelola daftar akun Administrator sistem SakaraEdu.</p>
        </div>
        <a href="{{ route('super-admin.admins.create') }}" class="inline-flex justify-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
            + Tambah Admin
        </a>
    </div>

    <div class="animate-fade-up">
        <livewire:admin-management-table />
    </div>
@endsection
