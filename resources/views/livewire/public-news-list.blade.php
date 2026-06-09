<div>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-deep-navy font-heading">Berita Edukasi</h2>
        
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <select wire:model.live="category" class="block w-full sm:w-40 rounded-xl border-0 py-2.5 pl-3 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6 shadow-sm">
                <option value="all">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
            
            <div class="relative w-full sm:w-80">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full rounded-xl border-0 py-2.5 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6 shadow-sm" placeholder="Cari berita...">
            </div>
        </div>
    </div>

    <!-- Skeleton Loading State -->
    <div wire:loading.grid class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 w-full">
        @for ($i = 0; $i < 6; $i++)
            <article class="card-hover flex flex-col items-start justify-between rounded-2xl bg-white p-5 shadow-sm border border-slate-200">
                <div class="h-44 w-full animate-pulse rounded-xl bg-slate-100"></div>
                <div class="mt-4 flex items-center gap-x-4 w-full">
                    <div class="h-4 w-20 animate-pulse rounded bg-slate-100"></div>
                    <div class="h-6 w-16 animate-pulse rounded-full bg-slate-100"></div>
                </div>
                <div class="mt-3 w-full">
                    <div class="h-6 w-3/4 animate-pulse rounded bg-slate-100"></div>
                    <div class="mt-2 h-4 w-full animate-pulse rounded bg-slate-100"></div>
                    <div class="mt-2 h-4 w-2/3 animate-pulse rounded bg-slate-100"></div>
                </div>
                <div class="mt-5 h-10 w-full animate-pulse rounded-xl bg-slate-100"></div>
            </article>
        @endfor
    </div>

    <!-- Data Cards -->
    <div wire:loading.remove class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($news as $item)
            <article class="card-hover flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div>
                    <div class="relative w-full mb-4 overflow-hidden rounded-xl aspect-video bg-slate-100 flex items-center justify-center">
                        @if($item->thumbnail)
                            <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->title }}" class="absolute inset-0 h-full w-full object-cover">
                        @else
                            <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        @endif
                    </div>
                    
                    <div class="mt-2 flex items-center gap-x-4 text-xs">
                        <time datetime="{{ $item->created_at->format('Y-m-d') }}" class="text-slate-500">{{ $item->created_at->format('M d, Y') }}</time>
                        <span class="rounded-full bg-slate-100 px-3 py-1.5 font-medium text-slate-600">{{ $item->category }}</span>
                    </div>
                    
                    <h3 class="mt-3 text-lg font-bold leading-tight text-deep-navy line-clamp-2">
                        {{ $item->title }}
                    </h3>
                    
                    <p class="mt-3 line-clamp-3 text-sm text-slate-text">
                        {{ Str::limit(strip_tags($item->content), 120) }}
                    </p>
                </div>

                <a href="{{ route('news.show', $item->slug) }}" class="mt-5 inline-flex w-full justify-center rounded-xl bg-slate-50 px-4 py-2 text-sm font-semibold text-deep-navy border border-slate-200 transition hover:bg-slate-100">
                    Baca Berita
                </a>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Tidak ada berita ditemukan</h3>
                <p class="mt-1 text-sm text-slate-500">Belum ada berita yang diterbitkan dalam kategori ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>