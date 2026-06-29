<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
    <h3 class="font-heading text-xl font-bold text-deep-navy mb-6 flex items-center gap-2">
        <svg class="h-5 w-5 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Diskusi ({{ $comments->count() }})
    </h3>

    {{-- Form Submit --}}
    @auth
        <form wire:submit="submit" class="mb-8">
            <div class="flex items-start gap-3">
                {{-- Avatar --}}
                <div class="shrink-0">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->profile_photo) }}"
                             alt="{{ auth()->user()->name }}"
                             class="h-10 w-10 rounded-full object-cover border-2 border-slate-200">
                    @else
                        <div class="h-10 w-10 rounded-full bg-primary-blue flex items-center justify-center border-2 border-slate-200">
                            <span class="text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <textarea
                        wire:model="body"
                        rows="3"
                        placeholder="Tulis pertanyaan atau komentar kamu tentang beasiswa ini..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition resize-none @error('body') border-red-400 @enderror"
                    ></textarea>
                    @error('body')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-2 flex justify-end">
                        <button type="submit"
                                class="rounded-xl bg-primary-blue px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-all hover:-translate-y-0.5"
                                wire:loading.attr="disabled" wire:loading.class="opacity-70">
                            <span wire:loading.remove wire:target="submit">Kirim Komentar</span>
                            <span wire:loading wire:target="submit">Mengirim...</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="mb-8 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
            <p class="text-sm text-slate-600">
                <a href="{{ route('login') }}" class="font-semibold text-primary-blue hover:text-sky-blue transition-colors">Login</a>
                untuk bisa berkomentar.
            </p>
        </div>
    @endauth

    {{-- Comments List --}}
    <div class="space-y-5">
        @forelse($comments as $comment)
            <div class="flex items-start gap-3 animate-fade-up" wire:key="comment-{{ $comment->id }}">
                {{-- Avatar --}}
                <div class="shrink-0">
                    @if($comment->user?->profile_photo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($comment->user->profile_photo) }}"
                             alt="{{ $comment->user->name }}"
                             class="h-9 w-9 rounded-full object-cover border border-slate-200">
                    @else
                        <div class="h-9 w-9 rounded-full bg-slate-200 flex items-center justify-center">
                            <span class="text-sm font-bold text-slate-600">{{ strtoupper(substr($comment->user?->name ?? '?', 0, 1)) }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2 flex-wrap">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-semibold text-deep-navy">{{ $comment->user?->name ?? 'Pengguna' }}</span>
                            <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        @auth
                            @if(auth()->id() === $comment->user_id)
                                <button wire:click="deleteComment({{ $comment->id }})"
                                        wire:confirm="Hapus komentar ini?"
                                        class="text-xs text-red-400 hover:text-red-600 transition-colors">
                                    Hapus
                                </button>
                            @endif
                        @endauth
                    </div>
                    <div class="mt-1 rounded-xl rounded-tl-none bg-slate-50 border border-slate-100 px-4 py-3">
                        <p class="text-sm text-slate-700 whitespace-pre-wrap">{{ $comment->body }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <p class="mt-2 text-sm text-slate-400">Belum ada komentar. Jadilah yang pertama!</p>
            </div>
        @endforelse
    </div>
</div>
