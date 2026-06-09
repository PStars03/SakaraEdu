@extends('layouts.dashboard')

@section('title', 'Manajemen Beasiswa - Admin')
@section('header', 'Manajemen Beasiswa')

@section('content')
    @if(session('success'))
        <div class="mb-4 rounded-xl bg-green-50 p-4">
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="animate-fade-up">
        <livewire:admin-scholarship-table />
    </div>
@endsection
