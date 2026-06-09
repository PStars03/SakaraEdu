@extends('layouts.dashboard')

@section('title', 'Super Admin Panel')
@section('header', 'Super Admin Panel')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow-sm border border-slate-100">
        <h2 class="font-heading text-2xl font-bold text-deep-navy">Selamat Datang, Super Admin! 👋</h2>
        <p class="mt-2 text-slate-text">Ini adalah panel kendali utama. Anda memiliki akses penuh untuk mengelola semua data sistem, termasuk manajemen admin.</p>
    </div>

    <livewire:super-admin-dashboard-stats />
@endsection
