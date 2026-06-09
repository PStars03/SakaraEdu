@extends('layouts.dashboard')

@section('title', 'Detail Rencana Keuangan')
@section('header', 'Detail Rencana: ' . $plan->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('uang-beasiswa.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Daftar Rencana</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <div class="mb-8 grid gap-6 sm:grid-cols-2">
            <div>
                <h3 class="text-lg font-bold text-deep-navy mb-1">{{ $plan->title }}</h3>
                <p class="text-sm text-slate-500">Dibuat pada: {{ $plan->created_at->format('d F Y') }}</p>
                <div class="mt-4 flex gap-2">
                    @if($plan->uses_transport)
                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Transportasi</span>
                    @endif
                    @if($plan->uses_rent)
                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Kos/Sewa</span>
                    @endif
                </div>
            </div>
            <div class="sm:text-right">
                <p class="text-sm font-medium text-slate-500">Total Uang Beasiswa</p>
                <p class="text-3xl font-bold text-primary-blue">Rp {{ number_format($plan->scholarship_amount, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="rounded-2xl bg-soft-bg p-6">
            <h4 class="mb-4 text-base font-semibold text-deep-navy border-b border-slate-200 pb-2">Rincian Alokasi</h4>
            <div class="space-y-4">
                @if($plan->rent_percentage > 0)
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700">Biaya Kos / Tempat Tinggal ({{ $plan->rent_percentage }}%)</span>
                    <span class="font-bold text-deep-navy">Rp {{ number_format(($plan->rent_percentage / 100) * $plan->scholarship_amount, 0, ',', '.') }}</span>
                </div>
                @endif

                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700">Biaya Makan & Hidup ({{ $plan->food_percentage }}%)</span>
                    <span class="font-bold text-deep-navy">Rp {{ number_format(($plan->food_percentage / 100) * $plan->scholarship_amount, 0, ',', '.') }}</span>
                </div>

                @if($plan->transport_percentage > 0)
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700">Biaya Transportasi ({{ $plan->transport_percentage }}%)</span>
                    <span class="font-bold text-deep-navy">Rp {{ number_format(($plan->transport_percentage / 100) * $plan->scholarship_amount, 0, ',', '.') }}</span>
                </div>
                @endif

                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700">Tabungan / Investasi ({{ $plan->saving_percentage }}%)</span>
                    <span class="font-bold text-fresh-green">Rp {{ number_format(($plan->saving_percentage / 100) * $plan->scholarship_amount, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700">Lain-lain / Dana Darurat ({{ $plan->other_percentage }}%)</span>
                    <span class="font-bold text-deep-navy">Rp {{ number_format(($plan->other_percentage / 100) * $plan->scholarship_amount, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="mt-6 border-t border-slate-200 pt-4 flex justify-between items-center">
                <span class="font-bold text-slate-800">Total Keseluruhan (100%)</span>
                <span class="font-bold text-primary-blue">Rp {{ number_format($plan->scholarship_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-8 flex gap-4">
            <a href="{{ route('uang-beasiswa.edit', $plan->id) }}" class="rounded-xl bg-primary-blue px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
                Edit Rencana
            </a>
            <form action="{{ route('uang-beasiswa.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rencana ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-xl border border-red-500 text-red-500 bg-white px-6 py-2 text-sm font-semibold shadow-sm hover:bg-red-50 transition-colors">
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endsection
