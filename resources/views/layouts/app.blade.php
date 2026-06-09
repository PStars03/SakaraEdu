<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SakaraEdu - Platform Beasiswa & Bootcamp')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/sakaraedu-logo-icon.png') }}">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-soft-bg font-sans text-slate-text antialiased">
    <nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <div class="flex shrink-0 items-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-10 w-auto">
                        </a>
                    </div>
                    <div class="hidden sm:-my-px sm:ml-8 sm:flex sm:space-x-8">
                        <a href="{{ route('scholarships.index') }}" class="inline-flex items-center border-b-2 {{ request()->routeIs('scholarships.*') ? 'border-primary-blue text-primary-blue' : 'border-transparent text-slate-text hover:border-primary-blue hover:text-primary-blue' }} px-1 pt-1 text-sm font-medium transition-colors">Beasiswa</a>
                        <a href="{{ route('bootcamps.index') }}" class="inline-flex items-center border-b-2 {{ request()->routeIs('bootcamps.*') ? 'border-primary-blue text-primary-blue' : 'border-transparent text-slate-text hover:border-primary-blue hover:text-primary-blue' }} px-1 pt-1 text-sm font-medium transition-colors">Bootcamp</a>
                        <a href="{{ route('news.index') }}" class="inline-flex items-center border-b-2 {{ request()->routeIs('news.*') ? 'border-primary-blue text-primary-blue' : 'border-transparent text-slate-text hover:border-primary-blue hover:text-primary-blue' }} px-1 pt-1 text-sm font-medium transition-colors">Berita</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-deep-navy hover:text-primary-blue transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-deep-navy hover:text-primary-blue transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white transition hover:bg-deep-navy shadow-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <footer class="bg-deep-navy py-12 mt-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="SakaraEdu" class="h-10 w-10 brightness-0 invert">
                    <span class="font-heading text-xl font-bold text-white">SakaraEdu</span>
                </div>
                <p class="text-sm text-slate-300">&copy; {{ date('Y') }} SakaraEdu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
