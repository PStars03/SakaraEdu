@extends('layouts.app')

@section('title', 'E-Ticket - ' . $ticket->bootcamp->title)

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('user.tickets.index') }}" class="inline-flex items-center text-sm font-semibold text-primary-blue hover:text-sky-blue transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Riwayat
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Simpan PDF / Cetak
            </button>
        </div>

        {{-- Ticket Container --}}
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl overflow-hidden relative">
            
            {{-- Cutouts for Ticket Effect --}}
            <div class="absolute left-0 top-1/3 -ml-4 h-8 w-8 rounded-full bg-slate-50 border-r border-slate-200 shadow-inner"></div>
            <div class="absolute right-0 top-1/3 -mr-4 h-8 w-8 rounded-full bg-slate-50 border-l border-slate-200 shadow-inner"></div>
            
            {{-- Top Half: Header & Event Info --}}
            <div class="p-8 pb-10 border-b-2 border-dashed border-slate-200 relative">
                <div class="flex justify-between items-start mb-6">
                    <img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-8 w-auto grayscale opacity-50">
                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">LUNAS</span>
                </div>

                <div class="mb-8">
                    <p class="text-xs font-bold tracking-widest text-primary-blue uppercase mb-2">E-TICKET RESMI</p>
                    <h1 class="font-heading text-2xl font-black text-deep-navy leading-tight">{{ $ticket->bootcamp->title }}</h1>
                    <p class="text-sm text-slate-500 mt-2">Diselenggarakan oleh <span class="font-bold text-slate-700">{{ $ticket->bootcamp->organizer }}</span></p>
                </div>

                <div class="grid grid-cols-2 gap-6 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Tanggal & Waktu</p>
                        <p class="text-sm font-bold text-slate-800">{{ $ticket->bootcamp->start_date->format('d M Y') }}</p>
                        <p class="text-xs font-medium text-slate-500">s/d {{ $ticket->bootcamp->end_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Lokasi / Platform</p>
                        <p class="text-sm font-bold text-slate-800">{{ $ticket->bootcamp->location }}</p>
                    </div>
                </div>
            </div>

            {{-- Bottom Half: User Info & QR Code --}}
            <div class="p-8 pt-10 bg-gradient-to-br from-white to-slate-50 relative">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-8">
                    
                    {{-- User Details --}}
                    <div class="w-full space-y-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Nama Peserta</p>
                            <p class="text-lg font-bold text-deep-navy">{{ $ticket->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Email</p>
                            <p class="text-sm font-bold text-slate-700">{{ $ticket->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Order ID</p>
                            <p class="text-xs font-mono font-bold text-slate-600 bg-white border border-slate-200 px-2 py-1 rounded inline-block">{{ $ticket->order_id }}</p>
                        </div>
                    </div>

                    {{-- Dummy QR Code --}}
                    <div class="shrink-0 text-center">
                        <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm inline-block">
                            <!-- SVG Dummy QR Code for visual purposes -->
                            <svg class="h-32 w-32 text-deep-navy" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h3v2h-3v-2zm-3 0h2v2h-2v-2zm3 3h3v2h-3v-2zm-3 0h2v2h-2v-2zm3 3h3v2h-3v-2zm-3 0h2v2h-2v-2zm0-6h-2v2h2v-2zm-2 2h-2v2h2v-2zm-2 2h2v2h-2v-2zm2 2h2v2h-2v-2z"/>
                            </svg>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-2 font-mono uppercase tracking-widest">Valid Entry</p>
                    </div>

                </div>
            </div>
            
            {{-- Footer Note --}}
            <div class="bg-deep-navy px-8 py-4 text-center">
                <p class="text-xs text-blue-200">Tunjukkan e-ticket ini saat registrasi ulang di lokasi acara atau masukkan Order ID di platform webinar.</p>
            </div>
            
        </div>
        
    </div>
</div>

<style>
    @media print {
        body { background: white !important; }
        .bg-slate-50 { background: white !important; }
        nav, footer, button, a { display: none !important; }
        .shadow-xl, .shadow-sm { box-shadow: none !important; }
        .border-slate-200 { border-color: #e2e8f0 !important; }
        .bg-deep-navy { background-color: #172B5F !important; color: white !important; -webkit-print-color-adjust: exact; }
        .bg-green-100 { background-color: #dcfce7 !important; color: #15803d !important; -webkit-print-color-adjust: exact; }
    }
</style>
@endsection
