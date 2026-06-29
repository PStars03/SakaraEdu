@extends('layouts.app')

@section('title', 'Checkout: ' . $bootcamp->title . ' - SakaraEdu')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-blue transition-colors">Beranda</a>
            <svg class="h-3.5 w-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <a href="{{ route('bootcamps.index') }}" class="hover:text-primary-blue transition-colors">Bootcamp</a>
            <svg class="h-3.5 w-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <a href="{{ route('bootcamps.show', $bootcamp->slug) }}" class="hover:text-primary-blue transition-colors line-clamp-1 max-w-xs">{{ $bootcamp->title }}</a>
            <svg class="h-3.5 w-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <span class="text-slate-700 font-medium">Checkout</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- ===== LEFT: Checkout Form ===== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Step Indicator --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 animate-fade-up">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <span class="h-7 w-7 rounded-full bg-primary-blue text-white text-xs font-bold flex items-center justify-center">1</span>
                            <span class="text-sm font-bold text-primary-blue">Pilih Tiket</span>
                        </div>
                        <div class="flex-1 h-px bg-slate-200"></div>
                        <div class="flex items-center gap-2">
                            <span class="h-7 w-7 rounded-full bg-primary-blue text-white text-xs font-bold flex items-center justify-center">2</span>
                            <span class="text-sm font-bold text-primary-blue">Metode Bayar</span>
                        </div>
                        <div class="flex-1 h-px bg-slate-200"></div>
                        <div class="flex items-center gap-2">
                            <span class="h-7 w-7 rounded-full bg-slate-200 text-slate-500 text-xs font-bold flex items-center justify-center">3</span>
                            <span class="text-sm font-medium text-slate-400">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                {{-- Ticket Summary --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 animate-fade-up" style="animation-delay: 80ms">
                    <h2 class="font-bold text-deep-navy text-lg mb-4 pb-3 border-b border-slate-100">Ringkasan Pesanan</h2>

                    <div class="flex gap-4">
                        @if($bootcamp->poster)
                            <img src="{{ Str::startsWith($bootcamp->poster, 'http') ? $bootcamp->poster : Storage::url($bootcamp->poster) }}"
                                 alt="{{ $bootcamp->title }}"
                                 class="h-20 w-32 rounded-xl object-cover shrink-0">
                        @endif
                        <div class="flex-1 min-w-0">
                            <span class="text-xs font-semibold text-primary-blue bg-blue-50 px-2 py-0.5 rounded mb-1 inline-block">
                                {{ ucfirst($bootcamp->type ?? 'Bootcamp') }}
                            </span>
                            <h3 class="font-bold text-deep-navy leading-snug text-sm mt-1">{{ $bootcamp->title }}</h3>
                            <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $bootcamp->start_date->format('d M Y') }} — {{ $bootcamp->end_date->format('d M Y') }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                {{ $bootcamp->location }}
                            </p>
                        </div>
                        <div class="shrink-0 text-right">
                            <span class="font-bold text-primary-blue">
                                @if(!$bootcamp->is_paid)
                                    Gratis
                                @else
                                    Rp{{ number_format($bootcamp->price, 0, ',', '.') }}
                                @endif
                            </span>
                            <br><span class="text-xs text-slate-400">1x Tiket</span>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 animate-fade-up" style="animation-delay: 160ms" x-data="{ method: 'bca' }">
                    <h2 class="font-bold text-deep-navy text-lg mb-5 pb-3 border-b border-slate-100">Pilih Metode Pembayaran</h2>

                    <div class="space-y-3">
                        {{-- Transfer Bank --}}
                        <div class="font-semibold text-xs text-slate-400 uppercase tracking-wider mb-2">Transfer Bank</div>
                        @foreach([
                            ['id' => 'bca', 'name' => 'BCA Virtual Account', 'desc' => 'Transfer otomatis, konfirmasi instan', 'icon' => '🏦', 'color' => 'bg-blue-50 border-blue-200'],
                            ['id' => 'mandiri', 'name' => 'Mandiri Virtual Account', 'desc' => 'Tersedia di ATM dan m-banking Mandiri', 'icon' => '🏦', 'color' => 'bg-yellow-50 border-yellow-200'],
                            ['id' => 'bni', 'name' => 'BNI Virtual Account', 'desc' => 'Tersedia di ATM dan BNI Mobile', 'icon' => '🏦', 'color' => 'bg-orange-50 border-orange-200'],
                        ] as $bank)
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all hover:border-primary-blue"
                               :class="method === '{{ $bank['id'] }}' ? 'border-primary-blue bg-blue-50/50' : 'border-slate-200'">
                            <input type="radio" name="method" value="{{ $bank['id'] }}" x-model="method" class="hidden">
                            <span class="text-2xl">{{ $bank['icon'] }}</span>
                            <div class="flex-1">
                                <div class="font-bold text-sm text-deep-navy">{{ $bank['name'] }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $bank['desc'] }}</div>
                            </div>
                            <div class="h-5 w-5 rounded-full border-2 flex items-center justify-center transition-all"
                                 :class="method === '{{ $bank['id'] }}' ? 'border-primary-blue bg-primary-blue' : 'border-slate-300'">
                                <svg x-show="method === '{{ $bank['id'] }}'" class="h-2.5 w-2.5 text-white" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            </div>
                        </label>
                        @endforeach

                        {{-- E-Wallet --}}
                        <div class="font-semibold text-xs text-slate-400 uppercase tracking-wider mb-2 mt-4">Dompet Digital</div>
                        @foreach([
                            ['id' => 'gopay', 'name' => 'GoPay', 'desc' => 'Scan QR atau via aplikasi Gojek', 'icon' => '💚', 'color' => 'bg-green-50'],
                            ['id' => 'ovo', 'name' => 'OVO', 'desc' => 'Bayar langsung dari saldo OVO', 'icon' => '💜', 'color' => 'bg-purple-50'],
                            ['id' => 'qris', 'name' => 'QRIS (Semua E-Wallet)', 'desc' => 'Scan kode QR dengan aplikasi apapun', 'icon' => '📱', 'color' => 'bg-slate-50'],
                        ] as $ewallet)
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all hover:border-primary-blue"
                               :class="method === '{{ $ewallet['id'] }}' ? 'border-primary-blue bg-blue-50/50' : 'border-slate-200'">
                            <input type="radio" name="method" value="{{ $ewallet['id'] }}" x-model="method" class="hidden">
                            <span class="text-2xl">{{ $ewallet['icon'] }}</span>
                            <div class="flex-1">
                                <div class="font-bold text-sm text-deep-navy">{{ $ewallet['name'] }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $ewallet['desc'] }}</div>
                            </div>
                            <div class="h-5 w-5 rounded-full border-2 flex items-center justify-center transition-all"
                                 :class="method === '{{ $ewallet['id'] }}' ? 'border-primary-blue bg-primary-blue' : 'border-slate-300'">
                                <svg x-show="method === '{{ $ewallet['id'] }}'" class="h-2.5 w-2.5 text-white" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Data Diri --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 animate-fade-up" style="animation-delay: 240ms">
                    <h2 class="font-bold text-deep-navy text-lg mb-5 pb-3 border-b border-slate-100">Data Peserta</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" placeholder="Masukkan nama lengkap" value="{{ auth()->user()->name ?? '' }}"
                                   class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Aktif</label>
                            <input type="email" placeholder="email@example.com" value="{{ auth()->user()->email ?? '' }}"
                                   class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Telepon</label>
                            <input type="tel" placeholder="08xxxxxxxxxx"
                                   class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Asal Institusi / Kampus</label>
                            <input type="text" placeholder="Nama kampus / perusahaan"
                                   class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue">
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== RIGHT: Order Summary ===== --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">

                    {{-- Price Breakdown --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-fade-up" style="animation-delay: 80ms">
                        <div class="bg-slate-50 border-b border-slate-200 px-5 py-4 font-bold text-deep-navy">
                            Ringkasan Pembayaran
                        </div>
                        <div class="p-5 space-y-3 text-sm">
                            <div class="flex justify-between text-slate-600">
                                <span>Harga Tiket Reguler</span>
                                <span class="font-semibold">
                                    @if(!$bootcamp->is_paid) Rp 0 @else Rp{{ number_format($bootcamp->price, 0, ',', '.') }} @endif
                                </span>
                            </div>
                            @if($bootcamp->is_paid)
                            <div class="flex justify-between text-slate-600">
                                <span>Biaya Layanan</span>
                                <span class="font-semibold">Rp 5.000</span>
                            </div>
                            @endif
                            <div class="border-t border-slate-200 pt-3 flex justify-between font-bold text-deep-navy text-base">
                                <span>Total Bayar</span>
                                <span class="text-primary-blue text-xl">
                                    @if(!$bootcamp->is_paid)
                                        Rp 0
                                    @else
                                        Rp{{ number_format($bootcamp->price + 5000, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Pay Button --}}
                    <a href="{{ $bootcamp->registration_link }}" target="_blank"
                       class="w-full flex justify-center items-center gap-2 rounded-2xl py-4 text-sm font-bold text-white shadow-xl transition-all hover:-translate-y-1
                              {{ $bootcamp->is_paid ? 'bg-gradient-to-r from-primary-blue to-sky-blue hover:from-deep-navy hover:to-primary-blue' : 'bg-gradient-to-r from-fresh-green to-dark-green' }}">
                        @if(!$bootcamp->is_paid)
                            🎉 Daftar Sekarang (Gratis!)
                        @else
                            💳 Bayar Sekarang
                        @endif
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>

                    <p class="text-center text-xs text-slate-400">
                        Kamu akan diarahkan ke halaman resmi penyelenggara untuk menyelesaikan pendaftaran.
                    </p>

                    {{-- Security Badges --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 space-y-2.5">
                        <div class="flex items-center gap-2.5 text-xs text-slate-600">
                            <svg class="h-4 w-4 text-fresh-green shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            <span>Data aman & terenkripsi SSL</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-600">
                            <svg class="h-4 w-4 text-fresh-green shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            <span>Pembayaran 100% aman</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-600">
                            <svg class="h-4 w-4 text-fresh-green shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            <span>Dukungan 24/7 via WhatsApp</span>
                        </div>
                    </div>

                    {{-- Back link --}}
                    <a href="{{ route('bootcamps.show', $bootcamp->slug) }}" class="block text-center text-sm text-slate-500 hover:text-primary-blue transition-colors">
                        ← Kembali ke detail event
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
