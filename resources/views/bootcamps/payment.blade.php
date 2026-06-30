@extends('layouts.app')

@section('title', 'Instruksi Pembayaran - SakaraEdu')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
            
            {{-- Header --}}
            <div class="bg-primary-blue px-6 py-8 text-center text-white">
                <h1 class="text-2xl font-bold mb-2">Menunggu Pembayaran</h1>
                <p class="text-blue-100 text-sm">Selesaikan pembayaran sebelum batas waktu berakhir.</p>
                <div class="mt-4 text-3xl font-bold">
                    Rp{{ number_format($registration->amount, 0, ',', '.') }}
                </div>
                <p class="text-xs text-blue-200 mt-1">Order ID: {{ $registration->order_id }}</p>
            </div>

            <div class="p-8">
                
                {{-- Payment Method Logic --}}
                @php
                    $info = $registration->payment_info ?? [];
                    $method = $registration->payment_method;
                @endphp

                {{-- BCA & BNI Virtual Account --}}
                @if(in_array($method, ['bca', 'bni']))
                    @php
                        $vaNumber = $info['va_numbers'][0]['va_number'] ?? 'Sedang memproses...';
                        $bank = strtoupper($info['va_numbers'][0]['bank'] ?? $method);
                    @endphp
                    <div class="text-center mb-8">
                        <p class="text-sm font-semibold text-slate-500 mb-2">Transfer ke {{ $bank }} Virtual Account</p>
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl py-6 px-4">
                            <p class="text-3xl font-black text-deep-navy tracking-widest font-mono">{{ $vaNumber }}</p>
                        </div>
                        <p class="text-xs text-slate-400 mt-3">Salin nomor di atas dan gunakan menu Transfer > Virtual Account di ATM atau Mobile Banking Anda.</p>
                    </div>

                {{-- Mandiri Bill --}}
                @elseif($method == 'mandiri')
                    <div class="text-center mb-8">
                        <p class="text-sm font-semibold text-slate-500 mb-2">Mandiri Bill Payment</p>
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl py-6 px-4 flex justify-around">
                            <div>
                                <p class="text-xs text-slate-400">Kode Perusahaan</p>
                                <p class="text-xl font-bold text-deep-navy font-mono">{{ $info['biller_code'] ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Kode Pembayaran</p>
                                <p class="text-xl font-bold text-deep-navy font-mono">{{ $info['bill_key'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                {{-- OVO --}}
                @elseif($method == 'ovo')
                    <div class="text-center mb-8">
                        <div class="h-20 w-20 mx-auto bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-deep-navy mb-2">Cek Aplikasi OVO Anda</h2>
                        <p class="text-sm text-slate-600 max-w-sm mx-auto">Kami telah mengirimkan notifikasi pembayaran ke aplikasi OVO Anda. Silakan buka aplikasi OVO dan selesaikan pembayaran.</p>
                    </div>

                {{-- GoPay & QRIS --}}
                @elseif(in_array($method, ['gopay', 'qris']))
                    @php
                        // Untuk GoPay dan QRIS, Midtrans memberikan QR code link
                        $qrUrl = null;
                        if(isset($info['actions'])) {
                            foreach($info['actions'] as $action) {
                                if($action['name'] == 'generate-qr-code') {
                                    $qrUrl = $action['url'];
                                    break;
                                }
                            }
                        }
                    @endphp
                    <div class="text-center mb-8">
                        <p class="text-sm font-semibold text-slate-500 mb-4">Scan QRIS Berikut</p>
                        @if($qrUrl)
                            <div class="inline-block p-4 bg-white border-2 border-slate-200 rounded-2xl shadow-sm">
                                <img src="{{ $qrUrl }}" alt="QR Code" class="h-48 w-48 object-contain">
                            </div>
                        @else
                            <div class="p-4 bg-yellow-50 text-yellow-700 rounded-xl text-sm font-medium">
                                QR Code belum tersedia untuk saat ini.
                            </div>
                        @endif
                        <p class="text-xs text-slate-400 mt-4">Buka aplikasi dompet digital atau m-banking Anda, lalu scan QR code di atas.</p>
                    </div>
                @endif

                <div class="mt-8 border-t border-slate-100 pt-6">
                    <a href="{{ route('bootcamps.show', $bootcamp->slug) }}" class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3.5 rounded-xl transition-colors">
                        Kembali ke Detail Bootcamp
                    </a>
                </div>

            </div>
        </div>
        
        <p class="text-center text-xs text-slate-400 mt-6">
            Pembayaran diproses secara aman oleh Midtrans.
        </p>
    </div>
</div>
@endsection
