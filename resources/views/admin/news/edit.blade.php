@extends('layouts.dashboard')

@section('title', 'Edit Berita - Admin')
@section('header', 'Edit Berita: ' . $news->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.berita.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue">← Kembali ke Daftar Berita</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <form action="{{ route('admin.berita.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="rounded-xl bg-red-50 p-4">
                    <ul class="list-disc pl-5 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-deep-navy">Judul Berita</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="category" class="block text-sm font-medium text-deep-navy">Kategori</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $news->category) }}" placeholder="Contoh: Pendidikan, Beasiswa, Tips" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="content" class="block text-sm font-medium text-deep-navy">Isi Berita</label>
                    <textarea name="content" id="content" rows="10" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">{{ old('content', $news->content) }}</textarea>
                </div>

                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-deep-navy">Ganti Thumbnail</label>
                    @if($news->thumbnail)
                        <div class="mb-2 w-32 rounded-lg border border-slate-200 overflow-hidden">
                            <img src="{{ Storage::url($news->thumbnail) }}" alt="Thumbnail saat ini">
                        </div>
                    @endif
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png,image/webp" class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-primary-blue/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-primary-blue hover:file:bg-primary-blue/20">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-deep-navy">Status</label>
                    <select name="status" id="status" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="rounded-xl bg-sky-blue px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-blue transition-colors">
                    Perbarui Berita
                </button>
            </div>
        </form>
    </div>
@endsection
