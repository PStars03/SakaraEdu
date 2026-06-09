@extends('layouts.dashboard')

@section('title', 'Tambah Beasiswa - Admin')
@section('header', 'Tambah Beasiswa Baru')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.beasiswa.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue">← Kembali ke Daftar Beasiswa</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <form action="{{ route('admin.beasiswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
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
                <div>
                    <label for="title" class="block text-sm font-medium text-deep-navy">Judul Beasiswa</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div>
                    <label for="organizer" class="block text-sm font-medium text-deep-navy">Penyelenggara</label>
                    <input type="text" name="organizer" id="organizer" value="{{ old('organizer') }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-medium text-deep-navy">Tanggal Mulai Pendaftaran</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-deep-navy">Tanggal Tutup Pendaftaran</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="location" class="block text-sm font-medium text-deep-navy">Lokasi (atau Online)</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="registration_link" class="block text-sm font-medium text-deep-navy">Link Pendaftaran Resmi</label>
                    <input type="url" name="registration_link" id="registration_link" value="{{ old('registration_link') }}" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                </div>

                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-deep-navy">Deskripsi Beasiswa</label>
                    <textarea name="description" id="description" rows="4" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">{{ old('description') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label for="requirements" class="block text-sm font-medium text-deep-navy">Persyaratan</label>
                    <textarea name="requirements" id="requirements" rows="4" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">{{ old('requirements') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label for="benefits" class="block text-sm font-medium text-deep-navy">Manfaat/Keuntungan</label>
                    <textarea name="benefits" id="benefits" rows="3" class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">{{ old('benefits') }}</textarea>
                </div>

                <div>
                    <label for="poster" class="block text-sm font-medium text-deep-navy">Poster (Opsional)</label>
                    <input type="file" name="poster" id="poster" accept="image/jpeg,image/png,image/webp" class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-primary-blue/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-primary-blue hover:file:bg-primary-blue/20">
                    <p class="mt-1 text-xs text-slate-500">Maks. 2MB. JPG, PNG, WEBP.</p>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-deep-navy">Status</label>
                    <select name="status" id="status" required class="mt-2 block w-full rounded-xl border-0 py-2 px-3 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="rounded-xl bg-primary-blue px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
                    Simpan Beasiswa
                </button>
            </div>
        </form>
    </div>
@endsection
