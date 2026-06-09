<div>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-deep-navy font-heading">Daftar Beasiswa</h2>
        
        <div class="relative w-full sm:w-96">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full rounded-xl border-0 py-2.5 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6 shadow-sm" placeholder="Cari beasiswa atau penyelenggara...">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($scholarships as $scholarship)
            <div class="group flex flex-col justify-between rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:-translate-y-1 hover:shadow-md card-hover">
                <div>
                    @if($scholarship->poster)
                        <div class="mb-4 overflow-hidden rounded-xl bg-slate-100 aspect-video flex items-center justify-center">
                            <img src="{{ Storage::url($scholarship->poster) }}" alt="{{ $scholarship->title }}" class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="mb-4 rounded-xl bg-primary-blue/10 p-3 inline-block">
                            <svg class="h-6 w-6 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                    <h3 class="text-lg font-bold leading-tight text-deep-navy line-clamp-2">
                        <a href="{{ route('scholarships.show', $scholarship->slug) }}" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            {{ $scholarship->title }}
                        </a>
                    </h3>
                    <p class="mt-2 text-sm text-slate-500">{{ $scholarship->organizer }}</p>
                    <div class="mt-4 flex items-center gap-2 text-sm text-slate-600">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $scholarship->location }}
                    </div>
                </div>
                <div class="mt-6 border-t border-slate-100 pt-4 flex items-center justify-between">
                    <p class="text-xs text-slate-500">
                        Tutup: <span class="font-medium text-slate-700">{{ $scholarship->end_date->format('d M Y') }}</span>
                    </p>
                    <span class="text-sm font-semibold text-primary-blue group-hover:text-sky-blue transition-colors">Lihat Detail →</span>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
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