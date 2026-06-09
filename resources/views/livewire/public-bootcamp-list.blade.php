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

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($bootcamps as $bootcamp)
            <div class="group relative flex flex-col justify-between rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:-translate-y-1 hover:shadow-md card-hover overflow-hidden">
                
                <!-- Price Badge -->
                <div class="absolute top-4 right-4 z-10">
                    @if(!$bootcamp->is_paid)
                        <span class="inline-flex items-center rounded-full bg-fresh-green/10 px-3 py-1 text-xs font-semibold text-dark-green ring-1 ring-inset ring-fresh-green/20 backdrop-blur-md">
                            Free
                        </span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-sky-blue/10 px-3 py-1 text-xs font-semibold text-primary-blue ring-1 ring-inset ring-sky-blue/20 backdrop-blur-md">
                            {{ $bootcamp->formatted_price }}
                        </span>
                    @endif
                </div>

                <div>
                    @if($bootcamp->poster)
                        <div class="mb-4 overflow-hidden rounded-xl bg-slate-100 aspect-video flex items-center justify-center">
                            <img src="{{ Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="mb-4 rounded-xl bg-fresh-green/10 p-3 inline-block">
                            <svg class="h-6 w-6 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    @endif
                    <h3 class="text-lg font-bold leading-tight text-deep-navy line-clamp-2 pr-16 mt-2">
                        <a href="{{ route('bootcamps.show', $bootcamp->slug) }}" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            {{ $bootcamp->title }}
                        </a>
                    </h3>
                    <p class="mt-2 text-sm text-slate-500">{{ $bootcamp->organizer }}</p>
                    <div class="mt-4 flex items-center gap-2 text-sm text-slate-600">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $bootcamp->location }}
                    </div>
                </div>
                <div class="mt-6 border-t border-slate-100 pt-4 flex items-center justify-between">
                    <p class="text-xs text-slate-500">
                        Mulai: <span class="font-medium text-slate-700">{{ $bootcamp->start_date->format('d M Y') }}</span>
                    </p>
                    <span class="text-sm font-semibold text-primary-blue group-hover:text-sky-blue transition-colors">Lihat Detail →</span>
                </div>
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