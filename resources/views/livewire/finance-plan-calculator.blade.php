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

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Left Column: Inputs -->
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-deep-navy">Nama Rencana (Opsional)</label>
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
                    
                    <label class="flex items-start space-x-3 cursor-pointer">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" name="uses_transport" value="1" wire:model.live="uses_transport" class="h-4 w-4 rounded border-slate-300 text-primary-blue focus:ring-primary-blue">
                        </div>
                        <div class="text-sm leading-6">
                            <span class="font-medium text-slate-900">Butuh Biaya Transportasi</span>
                            <p class="text-slate-500">Centang jika Anda memerlukan dana rutin untuk transportasi.</p>
                        </div>
                    </label>

                    <label class="flex items-start space-x-3 cursor-pointer">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" name="uses_rent" value="1" wire:model.live="uses_rent" class="h-4 w-4 rounded border-slate-300 text-primary-blue focus:ring-primary-blue">
                        </div>
                        <div class="text-sm leading-6">
                            <span class="font-medium text-slate-900">Butuh Biaya Kos / Sewa Tempat</span>
                            <p class="text-slate-500">Centang jika Anda menyewa tempat tinggal/kos.</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Right Column: Live Results -->
            <div class="rounded-2xl border border-slate-200 bg-soft-bg p-6">
                <h3 class="text-lg font-semibold text-deep-navy mb-4">Estimasi Alokasi Dana</h3>
                
                @if(!is_numeric($scholarship_amount) || $scholarship_amount < 100000)
                    <div class="flex h-40 items-center justify-center text-center text-sm text-slate-500">
                        Masukkan total uang beasiswa (minimal Rp 100.000) untuk melihat perhitungan.
                    </div>
                @else
                    <div class="space-y-4 animate-fade-up">
                        @php $amts = $this->amounts; $pcts = $this->percentages; @endphp

                        @if($pcts['rent'] > 0)
                        <div class="flex justify-between items-center pb-3 border-b border-slate-200">
                            <div>
                                <span class="block text-sm font-medium text-slate-700">Sewa/Kos ({{ $pcts['rent'] }}%)</span>
                            </div>
                            <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['rent'], 0, ',', '.') }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between items-center pb-3 border-b border-slate-200">
                            <div>
                                <span class="block text-sm font-medium text-slate-700">Kebutuhan Hidup & Makan ({{ $pcts['food'] }}%)</span>
                            </div>
                            <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['food'], 0, ',', '.') }}</span>
                        </div>

                        @if($pcts['transport'] > 0)
                        <div class="flex justify-between items-center pb-3 border-b border-slate-200">
                            <div>
                                <span class="block text-sm font-medium text-slate-700">Transportasi ({{ $pcts['transport'] }}%)</span>
                            </div>
                            <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['transport'], 0, ',', '.') }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between items-center pb-3 border-b border-slate-200">
                            <div>
                                <span class="block text-sm font-medium text-slate-700">Tabungan / Investasi ({{ $pcts['saving'] }}%)</span>
                            </div>
                            <span class="font-semibold text-fresh-green">Rp {{ number_format($amts['saving'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-3 border-b border-slate-200">
                            <div>
                                <span class="block text-sm font-medium text-slate-700">Lain-lain / Darurat ({{ $pcts['other'] }}%)</span>
                            </div>
                            <span class="font-semibold text-deep-navy">Rp {{ number_format($amts['other'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center pt-2">
                            <span class="text-base font-bold text-deep-navy">Total Alokasi (100%)</span>
                            <span class="text-lg font-bold text-primary-blue">Rp {{ number_format($amts['total'], 0, ',', '.') }}</span>
                        </div>
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