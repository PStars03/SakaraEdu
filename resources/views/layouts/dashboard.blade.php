<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - SakaraEdu</title>

    <link rel="icon" type="image/png" href="{{ asset('images/sakaraedu-logo-icon.png') }}">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="bg-soft-bg font-sans text-slate-text antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full transform bg-deep-navy text-white transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <div class="flex h-16 items-center justify-center border-b border-white/10 px-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="SakaraEdu" class="h-8 w-8 brightness-0 invert">
                    <span class="font-heading text-xl font-bold tracking-wide">SakaraEdu</span>
                </a>
            </div>

            <nav class="mt-6 flex flex-col space-y-1 px-4">
                @if(auth()->user()->isUser())
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        Dashboard User
                    </a>
                    <a href="{{ route('uang-beasiswa.index') }}" class="{{ request()->routeIs('uang-beasiswa.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Manajemen Keuangan
                    </a>
                @endif

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                        Dashboard Admin
                    </a>
                @endif
                
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('super-admin.dashboard') }}" class="{{ request()->routeIs('super-admin.dashboard') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        Dashboard Super Admin
                    </a>
                @endif

                @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <div class="my-3 border-t border-white/10"></div>
                    <p class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-400">Manajemen Konten</p>

                    <a href="{{ route('admin.beasiswa.index') }}" class="{{ request()->routeIs('admin.beasiswa.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        Beasiswa
                    </a>
                    
                    <a href="{{ route('admin.bootcamp.index') }}" class="{{ request()->routeIs('admin.bootcamp.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        Bootcamp
                    </a>
                    <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        Berita
                    </a>

                    @if(auth()->user()->isSuperAdmin())
                        <div class="my-3 border-t border-white/10"></div>
                        <p class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-400">Manajemen Akses</p>
                        
                        <a href="{{ route('super-admin.admins.index') }}" class="{{ request()->routeIs('super-admin.admins.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Manajemen Admin
                        </a>
                    @endif
                    @endif
                
                <div class="my-3 border-t border-white/10"></div>
                <p class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-400">Akun</p>

                <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                    <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Profil Saya
                </a>

                @if(auth()->user()->isUser())
                <a href="{{ route('bookmarks.index') }}" class="{{ request()->routeIs('bookmarks.*') ? 'bg-gradient-to-r from-primary-blue to-sky-blue text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                    <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                    Bookmark Saya
                </a>
                @endif

                <div class="my-3 border-t border-white/10"></div>
                <a href="{{ route('home') }}" class="text-slate-300 hover:bg-white/10 hover:text-white flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-colors">
                    <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" /></svg>
                    Kembali ke Beranda
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-6">
                <button @click="sidebarOpen = true" class="text-slate-500 md:hidden hover:text-primary-blue">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="hidden md:block">
                    <h1 class="font-heading text-xl font-semibold text-deep-navy">@yield('header')</h1>
                </div>
                
                <div class="flex items-center gap-4 ml-auto">
                    <span class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-100">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Mobile overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 md:hidden" style="display: none;"></div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-soft-bg p-6">
                <div class="animate-fade-up">
                    <h1 class="mb-6 font-heading text-2xl font-bold text-deep-navy md:hidden">@yield('header')</h1>
                    @yield('content')
                    {{ $slot ?? '' }}
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
