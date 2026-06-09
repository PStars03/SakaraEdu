@extends('layouts.app')

@section('title', 'Beasiswa - SakaraEdu')

@section('content')
<div class="bg-gradient-to-b from-soft-bg to-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <livewire:public-scholarship-list />
        </div>
    </div>
</div>
@endsection
