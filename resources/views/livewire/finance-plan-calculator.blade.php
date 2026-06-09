<div>
    <form action="{{ $plan && $plan->exists ? route('uang-beasiswa.update', $plan->id) : route('uang-beasiswa.store') }}" method="POST" class="space-y-8">
        @csrf
        @if($plan && $plan->exists)
            @method('PUT')
        @endif

        <!-- Hidden inputs for percentages to be submitted to controller -->
        <input type="hidden" name="rent_percentage" value="{{ $this->percentages['rent'] }}">
        <input type="hidden" name="food_percentage" value="{{ $this->percentages['food'] }}">
        <input type="hidden" name="transport_percentage" value="{{ $this->percentages['transport'] }}">
        <input type="hidden" name="saving_percentage" value="{{ $this->percentages['saving'] }}">
        <input type="hidden" name="other_percentage" value="{{ $this->percentages['other'] }}">
        <input type="hidden" name="uses_rent" value="0">
        <input type="hidden" name="uses_transport" value="0">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Left Column: Inputs -->
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-deep-navy">Nama Rencana</label>
                    <input type="text" name="title" id="title" wire:model.live="title" placeholder="Contoh: Rencana Semester 3" class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm" required>
                    @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="scholarship_amount" class="block text-sm font-medium text-deep-navy">Total Uang Beasiswa (Rp)</label>
                    <input type="number" name="scholarship_amount" id="scholarship_amount" wire:model.live="scholarship_amount" min="100000" placeholder="Contoh: 6000000" class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm" required>
                    @error('scholarship_amount') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-4">
                    <p class="text-sm font-medium text-deep-navy">Skenario Pengeluaran</p>
                    
                    <!-- Transport Checkbox + Nominal Input -->
                    <div class="rounded-xl border border-slate-200 p-4 transition-colors {{ $uses_transport ? 'bg-blue-50/50 border-blue-200' : 'bg-white' }}">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <div class="flex h-6 items-center">
                                <input type="checkbox" name="uses_transport" value="1" wire:model.live="uses_transport" class="h-4 w-4 rounded border-slate-300 text-primary-blue focus:ring-primary-blue">
                            </div>
                            <div class="text-sm leading-6">
                                <span class="font-medium text-slate-900">Butuh Biaya Transportasi</span>
                                <p class="text-slate-500">Centang jika Anda memerlukan dana rutin untuk transportasi.</p>
                            </div>
                        </label>

                        @if($uses_transport)
                        <div class="mt-3 ml-7 animate-fade-up">
                            <label for="transport_cost" class="block text-xs font-medium text-blue-700 mb-1">Biaya Transport per Hari (Rp)</label>
                            <input type="number" name="transport_cost" id="transport_cost" wire:model.live="transport_cost" min="0" placeholder="Contoh: 15000" class="block w-full rounded-lg border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-blue-300 focus:ring-2 focus:ring-blue-500 sm:text-sm shadow-sm bg-white">
                            @if(is_numeric($transport_cost) && $transport_cost > 0)
                                <p class="mt-1 text-xs text-blue-600">= Rp {{ number_format($transport_cost * 180, 0, ',', '.') }} / semester (180 hari)</p>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Rent Checkbox + Nominal Input -->
                    <div class="rounded-xl border border-slate-200 p-4 transition-colors {{ $uses_rent ? 'bg-purple-50/50 border-purple-200' : 'bg-white' }}">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <div class="flex h-6 items-center">
                                <input type="checkbox" name="uses_rent" value="1" wire:model.live="uses_rent" class="h-4 w-4 rounded border-slate-300 text-primary-blue focus:ring-primary-blue">
                            </div>
                            <div class="text-sm leading-6">
                                <span class="font-medium text-slate-900">Butuh Biaya Kos / Sewa Tempat</span>
                                <p class="text-slate-500">Centang jika Anda menyewa tempat tinggal/kos.</p>
                            </div>
                        </label>

                        @if($uses_rent)
                        <div class="mt-3 ml-7 animate-fade-up">
                            <label for="rent_cost" class="block text-xs font-medium text-purple-700 mb-1">Biaya Kos per Bulan (Rp)</label>
                            <input type="number" name="rent_cost" id="rent_cost" wire:model.live="rent_cost" min="0" placeholder="Contoh: 800000" class="block w-full rounded-lg border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-purple-300 focus:ring-2 focus:ring-purple-500 sm:text-sm shadow-sm bg-white">
                            @if(is_numeric($rent_cost) && $rent_cost > 0)
                                <p class="mt-1 text-xs text-purple-600">= Rp {{ number_format($rent_cost * 6, 0, ',', '.') }} / semester (6 bulan)</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                @php
                    $amts = $this->amounts;
                    $overBudget = ($amts['rent'] + $amts['transport']) > $amts['total'];
                @endphp
                @if($overBudget && is_numeric($scholarship_amount) && $scholarship_amount >= 100000)
                    <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700 animate-fade-up">
                        <strong>⚠️ Biaya kos + transport melebihi total beasiswa!</strong>
                        <p class="mt-1 text-xs">Silakan kurangi biaya kos/transport atau naikkan total beasiswa.</p>
                    </div>
                @endif
            </div>

            <!-- Right Column: Live Results -->
            <div class="rounded-2xl border border-slate-200 bg-soft-bg p-6">
                <h3 class="text-lg font-semibold text-deep-navy mb-4">Estimasi Alokasi Dana</h3>
                
                @if(!is_numeric($scholarship_amount) || $scholarship_amount < 100000)
                    <div class="flex h-40 items-center justify-center text-center text-sm text-slate-500">
                        Masukkan total uang beasiswa (minimal Rp 100.000) untuk melihat perhitungan.
                    </div>
                @else
                    @php 
                        $amts = $this->amounts; 
                        $pcts = $this->percentages; 
                        $daily = $this->dailyAmounts;
                        $monthly = $this->monthlyAmounts;
                    @endphp

                    <!-- Semester Overview -->
                    <div class="space-y-3 animate-fade-up">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Alokasi per Semester (6 bulan / 180 hari)</p>

                        @if($uses_rent)
                        <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    </span>
                                    <span class="text-sm font-medium text-slate-700">Sewa / Kos</span>
                                </div>
                                <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['rent'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1 rounded-md bg-purple-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Rp {{ number_format($monthly['rent'], 0, ',', '.') }} / bulan
                                </span>
                            </div>
                        </div>
                        @endif

                        <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                    </span>
                                    <span class="text-sm font-medium text-slate-700">Uang Makan</span>
                                </div>
                                <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['food'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1 rounded-md bg-orange-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    Rp {{ number_format($daily['food'], 0, ',', '.') }} / hari
                                </span>
                                <span class="inline-flex items-center gap-1 rounded-md bg-orange-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Rp {{ number_format($monthly['food'], 0, ',', '.') }} / bulan
                                </span>
                            </div>
                        </div>

                        @if($uses_transport)
                        <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                    </span>
                                    <span class="text-sm font-medium text-slate-700">Uang Transport</span>
                                </div>
                                <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['transport'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    Rp {{ number_format($daily['transport'], 0, ',', '.') }} / hari
                                </span>
                                <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Rp {{ number_format($monthly['transport'], 0, ',', '.') }} / bulan
                                </span>
                            </div>
                        </div>
                        @endif

                        <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-green-100 text-green-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </span>
                                    <span class="text-sm font-medium text-slate-700">Tabungan</span>
                                </div>
                                <span class="font-semibold text-fresh-green">Rp {{ number_format($amts['saving'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1 rounded-md bg-green-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Rp {{ number_format($monthly['saving'], 0, ',', '.') }} / bulan
                                </span>
                            </div>
                        </div>

                        <div class="rounded-xl bg-white p-4 border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </span>
                                    <span class="text-sm font-medium text-slate-700">Lain-lain</span>
                                </div>
                                <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['other'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    Rp {{ number_format($daily['other'], 0, ',', '.') }} / hari
                                </span>
                                <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2 py-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Rp {{ number_format($monthly['other'], 0, ',', '.') }} / bulan
                                </span>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="rounded-xl bg-gradient-to-r from-primary-blue to-deep-navy p-4 text-white shadow-md mt-2">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-bold">Total Alokasi (100%)</span>
                                <span class="text-lg font-bold">Rp {{ number_format($amts['total'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-white/70">
                                <span>≈ Rp {{ number_format($monthly['total'], 0, ',', '.') }} / bulan</span>
                                <span>≈ Rp {{ number_format($amts['total'] / 180, 0, ',', '.') }} / hari</span>
                            </div>
                        </div>

                        @if($amts['remaining'] < $amts['total'])
                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-3 text-xs text-slate-500">
                            <span class="font-medium text-slate-600">Sisa setelah Kos & Transport:</span> Rp {{ number_format($amts['remaining'], 0, ',', '.') }}
                            — dialokasikan untuk makan, tabungan, dan lain-lain.
                        </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="rounded-xl bg-primary-blue px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
                {{ $plan && $plan->exists ? 'Perbarui Rencana' : 'Simpan Rencana' }}
            </button>
        </div>
    </form>
</div>