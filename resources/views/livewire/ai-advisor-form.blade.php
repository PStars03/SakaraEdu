<div>
    <form action="{{ route('ai-advisor.store') }}" method="POST" class="space-y-0">
        @csrf

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">

            {{-- ============================================================ --}}
            {{-- LEFT: Input Form (3 cols) --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-3 space-y-6">

                {{-- Program Studi --}}
                <div>
                    <label for="major" class="block text-sm font-semibold text-deep-navy mb-1">
                        Program Studi / Jurusan
                    </label>
                    <input
                        type="text"
                        id="major"
                        name="major"
                        wire:model.live="major"
                        placeholder="Contoh: Teknik Informatika, Manajemen, Kedokteran…"
                        class="w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm"
                        required
                    >
                    @error('major') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- UKT / SPP --}}
                <div>
                    <label for="ukt_fee" class="block text-sm font-semibold text-deep-navy mb-1">
                        Biaya UKT / SPP per Semester (Rp)
                    </label>
                    <input
                        type="number"
                        id="ukt_fee"
                        name="ukt_fee"
                        wire:model.live="ukt_fee"
                        min="0"
                        placeholder="Contoh: 3500000"
                        class="w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm"
                        required
                    >
                    @error('ukt_fee') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Biaya Kos --}}
                <div>
                    <label for="monthly_rent" class="block text-sm font-semibold text-deep-navy mb-1">
                        Biaya Kos / Sewa per Bulan (Rp)
                        <span class="ml-1 text-xs font-normal text-slate-400">— opsional jika tidak kos</span>
                    </label>
                    <input
                        type="number"
                        id="monthly_rent"
                        name="monthly_rent"
                        wire:model.live="monthly_rent"
                        min="0"
                        placeholder="Contoh: 800000 — kosongkan jika tidak kos"
                        class="w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm"
                    >
                    @if(is_numeric($monthly_rent) && $monthly_rent > 0)
                        <p class="mt-1 text-xs text-purple-600">= Rp {{ number_format($monthly_rent * 6, 0, ',', '.') }} / semester (6 bulan)</p>
                    @endif
                    @error('monthly_rent') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Biaya Konsumsi --}}
                <div>
                    <label for="monthly_consumption" class="block text-sm font-semibold text-deep-navy mb-1">
                        Biaya Konsumsi / Makan per Bulan (Rp)
                    </label>
                    <input
                        type="number"
                        id="monthly_consumption"
                        name="monthly_consumption"
                        wire:model.live="monthly_consumption"
                        min="0"
                        placeholder="Contoh: 600000"
                        class="w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm"
                        required
                    >
                    @if(is_numeric($monthly_consumption) && $monthly_consumption > 0)
                        <p class="mt-1 text-xs text-orange-500">= Rp {{ number_format($monthly_consumption * 6, 0, ',', '.') }} / semester · Rp {{ number_format($monthly_consumption / 30, 0, ',', '.') }} / hari</p>
                    @endif
                    @error('monthly_consumption') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Biaya Transportasi --}}
                <div>
                    <label for="monthly_transport" class="block text-sm font-semibold text-deep-navy mb-1">
                        Biaya Transportasi per Hari (Rp)
                        <span class="ml-1 text-xs font-normal text-slate-400">— opsional</span>
                    </label>
                    <input
                        type="number"
                        id="monthly_transport"
                        name="monthly_transport"
                        wire:model.live="monthly_transport"
                        min="0"
                        placeholder="Contoh: 15000 — kosongkan jika tidak ada"
                        class="w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm"
                    >
                    @if(is_numeric($monthly_transport) && $monthly_transport > 0)
                        <p class="mt-1 text-xs text-blue-500">= Rp {{ number_format($monthly_transport * 180, 0, ',', '.') }} / semester (180 hari)</p>
                    @endif
                    @error('monthly_transport') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Dana Mandiri --}}
                <div>
                    <label for="self_fund" class="block text-sm font-semibold text-deep-navy mb-1">
                        Total Dana yang Tersedia (Rp)
                        <span class="ml-1 text-xs font-normal text-slate-400">— beasiswa + tabungan + dll.</span>
                    </label>
                    <input
                        type="number"
                        id="self_fund"
                        name="self_fund"
                        wire:model.live="self_fund"
                        min="0"
                        placeholder="Contoh: 6000000"
                        class="w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm"
                        required
                    >
                    @error('self_fund') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-primary-blue to-sky-blue px-6 py-3 text-sm font-semibold text-white shadow-md hover:shadow-lg hover:opacity-90 transition-all"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Analisis dengan AI
                </button>
                <p class="text-center text-xs text-slate-400">Proses analisis membutuhkan beberapa detik. Harap tunggu.</p>
            </div>

            {{-- ============================================================ --}}
            {{-- RIGHT: Live Preview (2 cols) --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-2">
                <div class="sticky top-6 rounded-2xl border border-slate-200 bg-soft-bg p-6">
                    <h3 class="text-base font-semibold text-deep-navy mb-4 flex items-center gap-2">
                        <svg class="h-4 w-4 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Preview Kalkulasi
                    </h3>

                    @if(!$this->isReady)
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <svg class="h-12 w-12 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-slate-400">Isi data di sebelah kiri untuk melihat preview kalkulasi.</p>
                        </div>
                    @else
                        @php
                            $bd  = $this->breakdown;
                            $tot = $this->totalExpense;
                            $sd  = $this->surplusDeficit;
                        @endphp

                        <div class="space-y-2 text-sm animate-fade-up">
                            {{-- UKT --}}
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-slate-600">Biaya UKT/SPP</span>
                                <span class="font-medium text-slate-800">Rp {{ number_format($bd['ukt'], 0, ',', '.') }}</span>
                            </div>

                            @if($bd['rent_total'] > 0)
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <div>
                                    <span class="text-slate-600">Biaya Kos</span>
                                    <span class="ml-1 text-xs text-slate-400">({{ number_format($bd['rent_month'], 0, ',', '.') }} × 6 bln)</span>
                                </div>
                                <span class="font-medium text-slate-800">Rp {{ number_format($bd['rent_total'], 0, ',', '.') }}</span>
                            </div>
                            @endif

                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <div>
                                    <span class="text-slate-600">Konsumsi</span>
                                    <span class="ml-1 text-xs text-slate-400">({{ number_format($bd['cons_month'], 0, ',', '.') }} × 6 bln)</span>
                                </div>
                                <span class="font-medium text-slate-800">Rp {{ number_format($bd['cons_total'], 0, ',', '.') }}</span>
                            </div>

                            @if($bd['trans_total'] > 0)
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <div>
                                    <span class="text-slate-600">Transportasi</span>
                                    <span class="ml-1 text-xs text-slate-400">({{ number_format($bd['trans_day'], 0, ',', '.') }} × 180 hari)</span>
                                </div>
                                <span class="font-medium text-slate-800">Rp {{ number_format($bd['trans_total'], 0, ',', '.') }}</span>
                            </div>
                            @endif

                            {{-- Total Expense --}}
                            <div class="rounded-xl bg-white border border-slate-200 p-3 mt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold text-slate-700">Total Pengeluaran</span>
                                    <span class="font-bold text-deep-navy">Rp {{ number_format($tot, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Dana tersedia --}}
                            <div class="rounded-xl bg-white border border-slate-200 p-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold text-slate-700">Dana Tersedia</span>
                                    <span class="font-bold text-primary-blue">Rp {{ number_format($this->self_fund ?: 0, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Surplus / Deficit --}}
                            <div class="rounded-xl p-3 {{ $sd >= 0 ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold {{ $sd >= 0 ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $sd >= 0 ? '✅ Surplus' : '⚠️ Defisit' }}
                                    </span>
                                    <span class="font-bold {{ $sd >= 0 ? 'text-green-700' : 'text-red-700' }}">
                                        Rp {{ number_format(abs($sd), 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-xs mt-1 {{ $sd >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $sd >= 0 ? 'Dana Anda mencukupi kebutuhan semester ini.' : 'Dana Anda kurang untuk menutup kebutuhan semester ini.' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
