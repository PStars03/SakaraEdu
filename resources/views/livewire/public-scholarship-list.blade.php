<div>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-deep-navy font-heading">Daftar Beasiswa</h2>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            {{-- Search --}}
            <div class="relative flex-1 sm:w-80">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                       class="block w-full rounded-xl border-0 py-2.5 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm shadow-sm"
                       placeholder="Cari beasiswa...">
            </div>

            {{-- Sort Dropdown --}}
            <select wire:model.live="sortBy"
                    class="rounded-xl border-0 py-2.5 px-4 text-sm text-slate-700 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue shadow-sm bg-white cursor-pointer">
                <option value="latest">Terbaru</option>
                <option value="deadline_asc">Deadline Terdekat ↑</option>
                <option value="deadline_desc">Deadline Terjauh ↓</option>
            </select>
        </div>
    </div>

    <!-- Skeleton Loading State -->
    <div wire:loading.grid class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 w-full">
        @for ($i = 0; $i < 6; $i++)
            <div class="flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="h-44 w-full animate-pulse rounded-xl bg-slate-100"></div>
                <div class="mt-4 w-full">
                    <div class="h-5 w-3/4 animate-pulse rounded bg-slate-100"></div>
                    <div class="mt-2 h-4 w-1/2 animate-pulse rounded bg-slate-100"></div>
                </div>
                <div class="mt-5 h-10 w-full animate-pulse rounded-xl bg-slate-100"></div>
            </div>
        @endfor
    </div>

    <!-- Data Cards -->
    <div wire:loading.remove class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($scholarships as $scholarship)
            @php
                $daysLeft = now()->startOfDay()->diffInDays($scholarship->end_date->startOfDay(), false);
            @endphp
            <div class="card-hover relative flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                
                {{-- Urgency Badge (absolute) --}}
                @if($daysLeft >= 0 && $daysLeft <= 7)
                    <div class="absolute top-3 right-3 z-10">
                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700 shadow-sm">
                            ⏰ Sisa {{ $daysLeft }} hari!
                        </span>
                    </div>
                @elseif($daysLeft >= 0 && $daysLeft <= 14)
                    <div class="absolute top-3 right-3 z-10">
                        <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                            ⚡ Sisa {{ $daysLeft }} hari
                        </span>
                    </div>
                @endif

                <div>
                    @if($scholarship->poster)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($scholarship->poster) }}" alt="{{ $scholarship->title }}" class="h-44 w-full rounded-xl object-cover">
                    @else
                        <div class="flex h-44 w-full items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                            <svg class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif

                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-deep-navy line-clamp-2">{{ $scholarship->title }}</h3>
                        <p class="mt-1 text-sm text-slate-text">{{ $scholarship->organizer }}</p>
                    </div>

                    <p class="mt-3 line-clamp-2 text-sm text-slate-text">
                        {{ $scholarship->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                    
                    <div class="mt-3 flex items-center gap-x-2 text-xs text-slate-500">
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        Deadline: {{ $scholarship->end_date->format('d M Y') }}
                    </div>

                    <div class="mt-1.5 flex items-center gap-x-2 text-xs text-slate-500">
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ $scholarship->location }}
                    </div>
                </div>

                <a href="{{ route('scholarships.show', $scholarship->slug) }}" class="mt-5 inline-flex w-full justify-center rounded-xl border-2 border-primary-blue bg-white px-4 py-2 text-sm font-semibold text-primary-blue transition hover:bg-primary-blue hover:text-white">
                    Lihat Beasiswa
                </a>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Tidak ada beasiswa ditemukan</h3>
                <p class="mt-1 text-sm text-slate-500">Coba ubah kata kunci pencarian Anda.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $scholarships->links() }}
    </div>
</div>