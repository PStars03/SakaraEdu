@extends('layouts.dashboard')

@section('title', 'Edit Profil')
@section('header', 'Edit Profil')

@section('content')
<div class="max-w-3xl mx-auto animate-fade-up">
    <div class="mb-4">
        <a href="{{ route('profile.show') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Profil</a>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
          class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        {{-- Errors --}}
        @if($errors->any())
            <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Foto Profil --}}
        <div>
            <h3 class="text-base font-bold text-deep-navy mb-4 pb-2 border-b border-slate-100">Foto Profil</h3>
            <div class="flex items-center gap-5">
                <div id="photo-preview-wrapper">
                    @if($user->profile_photo)
                        <img id="photo-preview" src="{{ Storage::url($user->profile_photo) }}" alt="Foto Profil"
                             class="h-20 w-20 rounded-full object-cover border-2 border-slate-200">
                    @else
                        <div id="photo-placeholder" class="h-20 w-20 rounded-full bg-primary-blue flex items-center justify-center border-2 border-slate-200">
                            <span class="text-2xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <img id="photo-preview" src="" alt="Preview" class="h-20 w-20 rounded-full object-cover border-2 border-slate-200 hidden">
                    @endif
                </div>
                <div>
                    <label for="profile_photo" class="cursor-pointer inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
                        <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pilih Foto
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden"
                           onchange="previewPhoto(this)">
                    <p class="mt-1.5 text-xs text-slate-400">JPG, PNG atau WEBP. Maks 2MB.</p>
                </div>
            </div>
        </div>

        {{-- Info Pribadi --}}
        <div>
            <h3 class="text-base font-bold text-deep-navy mb-4 pb-2 border-b border-slate-100">Informasi Pribadi</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition @error('name') border-red-400 @enderror">
                    @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition @error('email') border-red-400 @enderror">
                    @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">No. HP</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xx-xxxx-xxxx"
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">Domisili / Alamat</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" placeholder="Kota, Provinsi"
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition">
                </div>
            </div>
        </div>

        {{-- Informasi Akademik --}}
        @if(auth()->user()->isUser())
        <div>
            <h3 class="text-base font-bold text-deep-navy mb-4 pb-2 border-b border-slate-100">Informasi Akademik</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label for="campus" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kampus / Universitas</label>
                    <input type="text" id="campus" name="campus" value="{{ old('campus', $user->campus) }}" placeholder="Universitas Indonesia"
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition">
                </div>
                <div>
                    <label for="study_program" class="block text-sm font-medium text-slate-700 mb-1.5">Program Studi</label>
                    <input type="text" id="study_program" name="study_program" value="{{ old('study_program', $user->study_program) }}" placeholder="Teknik Informatika"
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition">
                </div>
                <div>
                    <label for="semester" class="block text-sm font-medium text-slate-700 mb-1.5">Semester</label>
                    <select id="semester" name="semester" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 transition">
                        <option value="">-- Pilih Semester --</option>
                        @for($i = 1; $i <= 14; $i++)
                            <option value="{{ $i }}" @selected(old('semester', $user->semester) == $i)>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="rounded-xl bg-primary-blue px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-all hover:-translate-y-0.5">
                Simpan Perubahan
            </button>
            <a href="{{ route('profile.show') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
function previewPhoto(input) {
    const preview = document.getElementById('photo-preview');
    const placeholder = document.getElementById('photo-placeholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
