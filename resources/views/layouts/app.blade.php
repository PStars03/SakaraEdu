<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SakaraEdu - Platform terlengkap untuk informasi beasiswa, bootcamp, workshop, dan edukasi terbaik di Indonesia.">
    <title>@yield('title', 'SakaraEdu - Beasiswa, Bootcamp & Workshop Terbaik Indonesia')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/sakaraedu-logo-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-soft-bg font-sans text-slate-text antialiased">

    <!-- ====== NAVBAR ====== -->
    <nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-sm" x-data="{ mobileOpen: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- Logo -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="shrink-0">
                        <img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-9 w-auto">
                    </a>

                    <!-- Desktop Nav Links -->
                    <div class="hidden lg:flex lg:items-center lg:gap-1">
                        <a href="{{ route('home') }}"
                           class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-primary-blue bg-blue-50' : 'text-slate-600 hover:text-primary-blue hover:bg-slate-50' }}">
                            Beranda
                        </a>
                        <a href="{{ route('scholarships.index') }}"
                           class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('scholarships.*') ? 'text-primary-blue bg-blue-50' : 'text-slate-600 hover:text-primary-blue hover:bg-slate-50' }}">
                            Beasiswa
                        </a>
                        <!-- Bootcamp & Workshop Dropdown -->
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button @click="open = !open"
                                class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('bootcamps.*') ? 'text-primary-blue bg-blue-50' : 'text-slate-600 hover:text-primary-blue hover:bg-slate-50' }}">
                                Event & Bootcamp
                                <svg class="h-4 w-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                 class="absolute left-0 top-full mt-1 w-56 rounded-xl border border-slate-200 bg-white shadow-xl py-2 z-50">
                                <a href="{{ route('bootcamps.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-primary-blue transition-colors">
                                    <span class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center text-primary-blue text-base">🚀</span>
                                    <div>
                                        <div class="font-semibold">Bootcamp</div>
                                        <div class="text-xs text-slate-500">Program intensif 2-8 minggu</div>
                                    </div>
                                </a>
                                <a href="{{ route('bootcamps.index') }}?type=workshop" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-primary-blue transition-colors">
                                    <span class="h-8 w-8 rounded-lg bg-green-100 flex items-center justify-center text-green-600 text-base">🛠️</span>
                                    <div>
                                        <div class="font-semibold">Workshop</div>
                                        <div class="text-xs text-slate-500">Event 1-2 hari praktis</div>
                                    </div>
                                </a>
                                <a href="{{ route('bootcamps.index') }}?type=webinar" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-primary-blue transition-colors">
                                    <span class="h-8 w-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 text-base">📡</span>
                                    <div>
                                        <div class="font-semibold">Webinar</div>
                                        <div class="text-xs text-slate-500">Sesi online gratis & berbayar</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('news.index') }}"
                           class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('news.*') ? 'text-primary-blue bg-blue-50' : 'text-slate-600 hover:text-primary-blue hover:bg-slate-50' }}">
                            Artikel & Tips
                        </a>
                    </div>
                </div>

                <!-- Right: Auth Actions -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:text-primary-blue hover:bg-slate-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-block rounded-lg px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-blue transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-all hover:-translate-y-0.5">
                            Daftar Gratis
                        </a>
                    @endauth

                    <!-- Mobile menu button -->
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                        <svg x-show="!mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg x-show="mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden border-t border-slate-100 bg-white px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-primary-blue">Beranda</a>
            <a href="{{ route('scholarships.index') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-primary-blue">Beasiswa</a>
            <a href="{{ route('bootcamps.index') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-primary-blue">Bootcamp</a>
            <a href="{{ route('bootcamps.index') }}?type=workshop" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-primary-blue">Workshop</a>
            <a href="{{ route('bootcamps.index') }}?type=webinar" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-primary-blue">Webinar</a>
            <a href="{{ route('news.index') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-primary-blue">Artikel & Tips</a>
            @auth
                <div class="border-t border-slate-100 pt-3 mt-3 flex gap-3">
                    <a href="{{ route('dashboard') }}" class="flex-1 text-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full rounded-xl border border-red-200 text-red-500 px-4 py-2 text-sm font-semibold">Keluar</button>
                    </form>
                </div>
            @else
                <div class="border-t border-slate-100 pt-3 mt-3 flex gap-3">
                    <a href="{{ route('login') }}" class="flex-1 text-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white">Daftar</a>
                </div>
            @endauth
        </div>
    </nav>

    <!-- ====== MAIN CONTENT ====== -->
    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- ====== FOOTER ====== -->
    <footer class="bg-deep-navy text-white mt-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Main Footer Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 py-16 border-b border-white/10">

                <!-- Brand Column -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="SakaraEdu" class="h-10 w-10 brightness-0 invert opacity-90">
                        <span class="text-xl font-bold font-heading">SakaraEdu</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed mb-5">
                        Platform edukasi terpercaya untuk menemukan beasiswa, bootcamp, dan workshop terbaik di Indonesia.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="h-9 w-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors" aria-label="Instagram">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="h-9 w-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors" aria-label="Twitter/X">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="h-9 w-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors" aria-label="LinkedIn">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="h-9 w-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors" aria-label="YouTube">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Links Column 1 -->
                <div>
                    <h3 class="font-bold text-sm mb-5 text-white/70 uppercase tracking-wider">Jelajahi</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('scholarships.index') }}" class="text-slate-300 hover:text-white transition-colors">Beasiswa S1</a></li>
                        <li><a href="{{ route('scholarships.index') }}" class="text-slate-300 hover:text-white transition-colors">Beasiswa S2 / S3</a></li>
                        <li><a href="{{ route('scholarships.index') }}" class="text-slate-300 hover:text-white transition-colors">Beasiswa Luar Negeri</a></li>
                        <li><a href="{{ route('bootcamps.index') }}" class="text-slate-300 hover:text-white transition-colors">Semua Bootcamp</a></li>
                        <li><a href="{{ route('bootcamps.index') }}" class="text-slate-300 hover:text-white transition-colors">Workshop & Event</a></li>
                        <li><a href="{{ route('bootcamps.index') }}" class="text-slate-300 hover:text-white transition-colors">Webinar Gratis</a></li>
                    </ul>
                </div>

                <!-- Links Column 2 -->
                <div>
                    <h3 class="font-bold text-sm mb-5 text-white/70 uppercase tracking-wider">Konten</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('news.index') }}" class="text-slate-300 hover:text-white transition-colors">Artikel Terbaru</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-slate-300 hover:text-white transition-colors">Tips Beasiswa</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-slate-300 hover:text-white transition-colors">Tips Karir IT</a></li>
                        @auth
                            <li><a href="{{ route('uang-beasiswa.index') }}" class="text-slate-300 hover:text-white transition-colors">Kalkulator Beasiswa</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition-colors">Kalkulator Beasiswa</a></li>
                        @endauth
                        <li><a href="{{ route('register') }}" class="text-slate-300 hover:text-white transition-colors">Daftar Akun</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div>
                    <h3 class="font-bold text-sm mb-5 text-white/70 uppercase tracking-wider">Kontak</h3>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-sky-blue shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            hello@sakaraedu.com
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-sky-blue shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                    <div class="mt-6 p-4 rounded-xl bg-white/5 border border-white/10">
                        <p class="text-xs text-slate-400 mb-2">Partner & Sponsor resmi:</p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-slate-300 bg-white/10 px-2 py-1 rounded-md">Kemendikbud</span>
                            <span class="text-xs font-semibold text-slate-300 bg-white/10 px-2 py-1 rounded-md">LPDP</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 py-6">
                <p class="text-sm text-slate-400">&copy; {{ date('Y') }} SakaraEdu. Hak cipta dilindungi undang-undang.</p>
                <div class="flex gap-6 text-sm text-slate-400">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        // Alpine.js inline for navbar dropdown
        document.addEventListener('alpine:init', () => {})
    </script>
</body>
</html>
