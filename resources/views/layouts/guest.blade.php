<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SakaraEdu - Authentication')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/sakaraedu-logo-icon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-soft-bg font-sans text-slate-text antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md animate-fade-up">
            <a href="{{ route('home') }}" class="flex justify-center">
                <img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-14 w-auto">
            </a>
            <h2 class="mt-6 text-center font-heading text-3xl font-bold tracking-tight text-deep-navy">
                @yield('header')
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-fade-up animate-delay-100">
            <div class="card-hover rounded-2xl border border-slate-200 bg-white px-4 py-8 shadow-sm sm:px-10">
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
