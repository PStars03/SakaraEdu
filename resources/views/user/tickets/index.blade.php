@extends('layouts.dashboard')

@section('title', 'Tiket & Transaksi Saya')
@section('header', 'Tiket & Transaksi Saya')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h2 class="font-semibold text-deep-navy">Riwayat Pembelian Bootcamp</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order ID / Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Bootcamp</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($tickets as $ticket)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-deep-navy font-mono">{{ $ticket->order_id }}</p>
                                <p class="text-xs text-slate-500 mt-1">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 shrink-0 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center">
                                        @if($ticket->bootcamp->poster)
                                            <img src="{{ Str::startsWith($ticket->bootcamp->poster, 'http') ? $ticket->bootcamp->poster : Storage::url($ticket->bootcamp->poster) }}" alt="Poster" class="h-full w-full object-cover">
                                        @else
                                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800 line-clamp-1">{{ $ticket->bootcamp->title }}</p>
                                        <p class="text-xs text-slate-500">{{ $ticket->bootcamp->organizer }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold {{ $ticket->amount > 0 ? 'text-slate-800' : 'text-fresh-green' }}">
                                    {{ $ticket->amount > 0 ? 'Rp' . number_format($ticket->amount, 0, ',', '.') : 'Gratis' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($ticket->status === 'success')
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700 ring-1 ring-inset ring-green-600/20">Berhasil</span>
                                @elseif($ticket->status === 'pending')
                                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2.5 py-1 text-xs font-semibold text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Menunggu Pembayaran</span>
                                @else
                                    <span class="inline-flex items-center rounded-md bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700 ring-1 ring-inset ring-red-600/20">Gagal/Expired</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($ticket->status === 'success')
                                    <a href="{{ route('user.tickets.show', $ticket->id) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-primary-blue px-3 py-2 text-xs font-semibold text-white hover:bg-deep-navy transition-colors">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        Lihat Tiket
                                    </a>
                                @elseif($ticket->status === 'pending')
                                    <a href="{{ route('bootcamps.payment', ['slug' => $ticket->bootcamp->slug, 'order_id' => $ticket->order_id]) }}" class="text-primary-blue hover:text-deep-navy font-semibold text-sm transition-colors">Lanjut Bayar &rarr;</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">Belum ada tiket</h3>
                                <p class="mt-1 text-sm text-slate-500">Anda belum pernah mendaftar atau membeli bootcamp.</p>
                                <a href="{{ route('bootcamps.index') }}" class="mt-4 inline-flex items-center justify-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
                                    Cari Bootcamp Sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
