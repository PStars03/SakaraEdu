@extends('layouts.app')

@section('title', $news->title . ' - SakaraEdu')

@section('content')
<div class="bg-gradient-to-b from-white to-soft-bg py-12">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Berita
            </a>
        </div>
        
        <article class="animate-fade-up">
            <div class="flex flex-wrap items-center gap-4 text-sm mb-6">
                <span class="inline-flex items-center rounded-full bg-primary-blue/10 px-3 py-1 font-semibold text-primary-blue ring-1 ring-inset ring-primary-blue/20">{{ $news->category }}</span>
                <span class="inline-flex items-center text-slate-500">
                    <svg class="mr-1.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <time datetime="{{ $news->created_at->format('Y-m-d') }}">{{ $news->created_at->format('d F Y') }}</time>
                </span>
            </div>
            
            <h1 class="mb-8 font-heading text-3xl font-bold tracking-tight text-deep-navy sm:text-5xl leading-tight">{{ $news->title }}</h1>
            
            @if($news->thumbnail)
                <div class="w-full overflow-hidden rounded-3xl mb-10 shadow-md ring-1 ring-slate-200">
                    <img src="{{ Storage::url($news->thumbnail) }}" alt="{{ $news->title }}" class="w-full object-cover aspect-video hover:scale-105 transition-transform duration-700">
                </div>
            @endif
            
            <div class="prose prose-lg prose-slate max-w-none text-slate-700 prose-headings:font-heading prose-headings:text-deep-navy prose-a:text-primary-blue hover:prose-a:text-sky-blue leading-loose">
                <p class="whitespace-pre-line text-justify">{{ $news->content }}</p>
            </div>
            
            <div class="mt-16 pt-8 border-t border-slate-200 flex items-center gap-4 bg-white p-6 rounded-2xl shadow-sm ring-1 ring-slate-100">
                <div class="h-14 w-14 rounded-full bg-gradient-to-br from-primary-blue to-sky-blue flex items-center justify-center text-white font-bold text-xl shadow-inner">
                    {{ substr($news->author->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Ditulis oleh</p>
                    <p class="text-lg font-bold text-deep-navy">{{ $news->author->name }}</p>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
