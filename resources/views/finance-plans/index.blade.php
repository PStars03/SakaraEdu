@extends('layouts.dashboard')

@section('title', 'Manajemen Uang Beasiswa')
@section('header', 'Manajemen Uang Beasiswa')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-slate-500">Kelola dan alokasikan dana beasiswa Anda dengan bijak.</p>
        </div>
        <a href="{{ route('uang-beasiswa.create') }}" class="inline-flex justify-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
            + Buat Rencana Baru
        </a>
    </div>

    @if($plans->isEmpty())
        <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-12 text-center animate-fade-up">
            <img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="Empty" class="h-16 w-16 opacity-20 grayscale">
            <h3 class="mt-4 text-lg font-semibold text-deep-navy">Belum ada rencana</h3>
            <p class="mt-2 text-sm text-slate-500">Anda belum membuat rencana manajemen uang beasiswa.</p>
            <a href="{{ route('uang-beasiswa.create') }}" class="mt-6 rounded-xl bg-primary-blue px-6 py-2 text-sm font-semibold text-white hover:bg-deep-navy transition-colors">
                Buat Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($plans as $plan)
                <div class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md animate-fade-up" style="animation-delay: {{ $loop->index * 50 }}ms">
                    <h3 class="text-lg font-bold text-deep-navy mb-1 line-clamp-1">{{ $plan->title }}</h3>
                    <p class="text-xs text-slate-400 mb-4">{{ $plan->created_at->format('d M Y') }}</p>
                    
                    <div class="mb-4 flex items-center justify-between rounded-xl bg-soft-bg p-3">
                        <span class="text-sm font-medium text-slate-600">Total Dana</span>
                        <span class="font-bold text-primary-blue">Rp {{ number_format($plan->scholarship_amount, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="mb-6 space-y-2 text-sm text-slate-600 flex-grow">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 {{ $plan->uses_rent ? 'text-fresh-green' : 'text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            <span class="{{ $plan->uses_rent ? 'text-slate-800' : 'text-slate-400 line-through' }}">Biaya Kos/Sewa</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 {{ $plan->uses_transport ? 'text-fresh-green' : 'text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                            <span class="{{ $plan->uses_transport ? 'text-slate-800' : 'text-slate-400 line-through' }}">Biaya Transportasi</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <a href="{{ route('uang-beasiswa.show', $plan->id) }}" class="text-sm font-semibold text-primary-blue hover:text-deep-navy transition-colors">
                            Lihat Detail →
                        </a>
                        <div class="flex gap-2">
                            <a href="{{ route('uang-beasiswa.edit', $plan->id) }}" class="p-2 text-slate-400 hover:text-sky-blue transition-colors rounded-lg hover:bg-slate-50" title="Edit">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            <form action="{{ route('uang-beasiswa.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rencana ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors rounded-lg hover:bg-red-50" title="Hapus">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
