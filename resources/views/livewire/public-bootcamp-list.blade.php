<div>
    {{-- Header & Filters --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold font-heading text-deep-navy">Bootcamp, Workshop & Webinar</h1>
                <p class="text-slate-500 text-sm mt-1">Temukan program pengembangan skill terbaik untukmu</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            {{-- Type Filter Pills --}}
            <div class="flex gap-2 flex-wrap">
                <button wire:click="$set('filterType', 'all')"
                    class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-all {{ $filterType === 'all' ? 'bg-primary-blue text-white shadow-sm' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary-blue hover:text-primary-blue' }}">
                    Semua
                </button>
                <button wire:click="$set('filterType', 'bootcamp')"
                    class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-all {{ $filterType === 'bootcamp' ? 'bg-deep-navy text-white shadow-sm' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary-blue hover:text-primary-blue' }}">
                    🚀 Bootcamp
                </button>
                <button wire:click="$set('filterType', 'workshop')"
                    class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-all {{ $filterType === 'workshop' ? 'bg-orange-500 text-white shadow-sm' : 'bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500' }}">
                    🛠️ Workshop
                </button>
                <button wire:click="$set('filterType', 'webinar')"
                    class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-all {{ $filterType === 'webinar' ? 'bg-purple-600 text-white shadow-sm' : 'bg-white text-slate-600 border border-slate-200 hover:border-purple-400 hover:text-purple-500' }}">
                    📡 Webinar
                </button>
            </div>

            <div class="sm:ml-auto flex gap-2 flex-wrap">
                {{-- Price Filter --}}
                <select wire:model.live="filterPrice"
                    class="block rounded-xl border border-slate-200 bg-white py-2 pl-3 pr-8 text-slate-700 text-sm font-medium focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue shadow-sm">
                    <option value="all">Semua Harga</option>
                    <option value="free">Gratis</option>
                    <option value="paid">Berbayar</option>
                </select>

                {{-- Sort --}}
                <select wire:model.live="sortBy"
                    class="block rounded-xl border border-slate-200 bg-white py-2 pl-3 pr-8 text-slate-700 text-sm font-medium focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue shadow-sm">
                    <option value="latest">Terbaru</option>
                    <option value="deadline_asc">Deadline Terdekat ↑</option>
                    <option value="deadline_desc">Deadline Terjauh ↓</option>
                </select>

                {{-- Search --}}
                <div class="relative flex-1 sm:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search"
                           type="text"
                           class="block w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-3 text-slate-700 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-primary-blue/30 focus:border-primary-blue shadow-sm"
                           placeholder="Cari nama atau penyelenggara...">
                </div>
            </div>
        </div>
    </div>

    {{-- Skeleton Loading State --}}
    <div wire:loading.grid class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 w-full">
        @for ($i = 0; $i < 6; $i++)
            <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                <div class="h-48 w-full skeleton"></div>
                <div class="p-5 space-y-3">
                    <div class="h-5 w-4/5 rounded-lg skeleton"></div>
                    <div class="h-4 w-3/5 rounded-lg skeleton"></div>
                    <div class="h-4 w-2/3 rounded-lg skeleton"></div>
                    <div class="h-10 w-full rounded-xl skeleton mt-4"></div>
                </div>
            </div>
        @endfor
    </div>

    {{-- Data Cards --}}
    <div wire:loading.remove class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($bootcamps as $bootcamp)
            <div class="group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

                {{-- Image --}}
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    @if($bootcamp->poster)
                        <img src="{{ Str::startsWith($bootcamp->poster, 'http') ? $bootcamp->poster : Storage::url($bootcamp->poster) }}"
                             alt="{{ $bootcamp->title }}"
                             class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="flex h-full items-center justify-center bg-gradient-to-br from-primary-blue/10 to-sky-blue/10 text-5xl">
                            {{ match($bootcamp->type ?? 'bootcamp') { 'workshop' => '🛠️', 'webinar' => '📡', default => '🚀' } }}
                        </div>
                    @endif

                    {{-- Type Badge --}}
                    <div class="absolute top-3 left-3">
                        @php
                            $badge = match($bootcamp->type ?? 'bootcamp') {
                                'workshop' => ['🛠️ Workshop', 'bg-orange-500'],
                                'webinar'  => ['📡 Webinar', 'bg-purple-600'],
                                default    => ['🚀 Bootcamp', 'bg-primary-blue'],
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold text-white {{ $badge[1] }} shadow">{{ $badge[0] }}</span>
                    </div>

                    {{-- Price Badge --}}
                    <div class="absolute top-3 right-3">
                        @if($bootcamp->is_paid)
                            <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-white text-primary-blue shadow">
                                Rp{{ number_format($bootcamp->price, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-fresh-green text-white shadow">
                                GRATIS
                            </span>
                        @endif
                    </div>

                    {{-- Level Badge --}}
                    @if($bootcamp->level)
                        <div class="absolute bottom-3 right-3">
                            <span class="inline-block px-2 py-0.5 rounded-md text-xs font-semibold bg-black/40 text-white backdrop-blur-sm">{{ $bootcamp->level }}</span>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex-1">
                        <h3 class="font-bold text-deep-navy line-clamp-2 leading-snug mb-2 group-hover:text-primary-blue transition-colors">
                            {{ $bootcamp->title }}
                        </h3>

                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                            {{ $bootcamp->description }}
                        </p>

                        <div class="space-y-1.5 text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $bootcamp->start_date->format('d M Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                {{ $bootcamp->location }}
                            </div>
                            @if($bootcamp->max_participants)
                            <div class="flex items-center gap-2">
                                <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Maks. {{ number_format($bootcamp->max_participants) }} peserta
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-3 mt-3 flex items-center gap-2">
                        <div class="h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 shrink-0">
                            {{ substr($bootcamp->organizer, 0, 1) }}
                        </div>
                        <span class="text-xs text-slate-500 truncate font-medium">{{ $bootcamp->organizer }}</span>
                    </div>

                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('bootcamps.show', $bootcamp->slug) }}"
                           class="flex-1 flex justify-center items-center rounded-xl border border-slate-200 py-2.5 text-sm font-semibold text-slate-600 hover:border-primary-blue hover:text-primary-blue transition-all">
                            Detail
                        </a>
                        @if($bootcamp->is_paid)
                        <a href="{{ route('bootcamps.checkout', $bootcamp->slug) }}"
                           class="flex-1 flex justify-center items-center gap-1 rounded-xl bg-primary-blue py-2.5 text-sm font-bold text-white hover:bg-deep-navy transition-all">
                            💳 Daftar
                        </a>
                        @else
                        <a href="{{ $bootcamp->registration_link }}" target="_blank"
                           class="flex-1 flex justify-center items-center gap-1 rounded-xl bg-fresh-green py-2.5 text-sm font-bold text-white hover:bg-dark-green transition-all">
                            Daftar Gratis
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 bg-white p-16 text-center">
                <div class="text-5xl mb-4">🔍</div>
                <h3 class="text-lg font-bold text-slate-700 mb-2">Tidak ada program ditemukan</h3>
                <p class="text-sm text-slate-500">Coba ubah kata kunci pencarian atau filter yang kamu gunakan.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $bootcamps->links() }}
    </div>
</div>