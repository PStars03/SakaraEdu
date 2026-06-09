<div>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-deep-navy font-heading">Daftar Bootcamp</h2>
        
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <select wire:model.live="filterPrice" class="block w-full sm:w-40 rounded-xl border-0 py-2.5 pl-3 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6 shadow-sm">
                <option value="all">Semua Tipe</option>
                <option value="free">Gratis (Free)</option>
                <option value="paid">Berbayar</option>
            </select>
            
            <div class="relative w-full sm:w-80">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full rounded-xl border-0 py-2.5 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6 shadow-sm" placeholder="Cari bootcamp...">
            </div>
        </div>
    </div>

    <!-- Skeleton Loading State -->
    <div wire:loading.grid class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 w-full">
        @for ($i = 0; $i < 6; $i++)
            <div class="card-hover flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="h-44 w-full animate-pulse rounded-xl bg-slate-100"></div>
                <div class="mt-4 flex items-start justify-between gap-3">
                    <div class="w-full">
                        <div class="h-5 w-3/4 animate-pulse rounded bg-slate-100"></div>
                        <div class="mt-2 h-4 w-1/2 animate-pulse rounded bg-slate-100"></div>
                    </div>
                </div>
                <div class="mt-3 h-4 w-2/3 animate-pulse rounded bg-slate-100"></div>
                <div class="mt-5 h-10 w-full animate-pulse rounded-xl bg-slate-100"></div>
            </div>
        @endfor
    </div>

    <!-- Data Cards -->
    <div wire:loading.remove class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($bootcamps as $bootcamp)
            <div class="card-hover flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div>
                    @if($bootcamp->poster)
                        <img src="{{ Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-44 w-full rounded-xl object-cover">
                    @else
                        <div class="flex h-44 w-full items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                            <svg class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                    @endif

                    <div class="mt-4 flex items-start justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-bold text-deep-navy line-clamp-2">{{ $bootcamp->title }}</h3>
                            <p class="mt-1 text-sm text-slate-text">{{ $bootcamp->organizer }}</p>
                        </div>

                        @if ($bootcamp->is_paid)
                            <span class="shrink-0 rounded-full bg-sky-blue/10 px-3 py-1 text-xs font-semibold text-primary-blue">
                                {{ $bootcamp->formatted_price }}
                            </span>
                        @else
                            <span class="shrink-0 rounded-full bg-fresh-green/10 px-3 py-1 text-xs font-semibold text-dark-green">
                                Free
                            </span>
                        @endif
                    </div>

                    <p class="mt-3 line-clamp-2 text-sm text-slate-text">
                        {{ $bootcamp->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                    
                    <div class="mt-3 flex items-center gap-x-2 text-sm text-slate-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ $bootcamp->location }}
                    </div>
                </div>

                <a href="{{ route('bootcamps.show', $bootcamp->slug) }}" class="mt-5 inline-flex w-full justify-center rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white transition hover:bg-deep-navy">
                    Lihat Detail
                </a>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Tidak ada bootcamp ditemukan</h3>
                <p class="mt-1 text-sm text-slate-500">Coba ubah kata kunci atau filter Anda.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $bootcamps->links() }}
    </div>
</div>