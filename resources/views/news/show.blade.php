@extends('layouts.app')

@section('title', $news->title . ' - SakaraEdu')

@section('content')
<div class="bg-white py-8">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('news.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Berita</a>
        </div>
        
        <article class="animate-fade-up">
            <div class="flex items-center gap-x-4 text-sm mb-6">
                <time datetime="{{ $news->created_at->format('Y-m-d') }}" class="text-slate-500">{{ $news->created_at->format('d F Y') }}</time>
                <span class="rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-600">{{ $news->category }}</span>
            </div>
            
            <h1 class="mb-8 font-heading text-3xl font-bold tracking-tight text-deep-navy sm:text-5xl leading-tight">{{ $news->title }}</h1>
            
            @if($news->thumbnail)
                <div class="w-full overflow-hidden rounded-2xl mb-10 shadow-sm ring-1 ring-slate-200">
                    <img src="{{ Storage::url($news->thumbnail) }}" alt="{{ $news->title }}" class="w-full object-cover aspect-video">
                </div>
            @endif
            
            <div class="prose prose-lg prose-slate max-w-none text-slate-700">
                <p class="whitespace-pre-line">{{ $news->content }}</p>
            </div>
            
            <div class="mt-12 pt-8 border-t border-slate-100 flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-sky-blue flex items-center justify-center text-white font-bold text-xl">
                    {{ substr($news->author->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-deep-navy">Ditulis oleh</p>
                    <p class="text-base font-semibold text-slate-900">{{ $news->author->name }}</p>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
