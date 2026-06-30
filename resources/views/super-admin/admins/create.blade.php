@extends('layouts.dashboard')

@section('title', 'Tambah Admin')
@section('header', 'Tambah Admin Baru')

@section('content')
    <div class="mb-4">
        <a href="{{ route('super-admin.admins.index') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors">← Kembali ke Daftar Admin</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 animate-fade-up">
        <form action="{{ route('super-admin.admins.store') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-deep-navy">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-2 block w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm" required>
                @error('name') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-deep-navy">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-2 block w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm" required>
                @error('email') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-deep-navy">Password</label>
                <div class="relative mt-2">
                    <input id="password" name="password" x-bind:type="show ? 'text' : 'password'" class="block w-full rounded-xl border-0 py-2.5 pl-4 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm" required>
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-primary-blue focus:outline-none transition-colors">
                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
                @error('password') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div x-data="{ show: false }">
                <label for="password_confirmation" class="block text-sm font-medium text-deep-navy">Konfirmasi Password</label>
                <div class="relative mt-2">
                    <input id="password_confirmation" name="password_confirmation" x-bind:type="show ? 'text' : 'password'" class="block w-full rounded-xl border-0 py-2.5 pl-4 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm" required>
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-primary-blue focus:outline-none transition-colors">
                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <hr class="border-slate-200">
            <h3 class="text-sm font-bold text-deep-navy">Informasi Pencairan Dana (Opsional)</h3>
            <p class="text-xs text-slate-500 mb-4">Informasi ini dibutuhkan agar Admin menerima pendapatan dari Bootcamp berbayar yang ia buat.</p>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="bank_name" class="block text-sm font-medium text-deep-navy">Nama Bank</label>
                    <select name="bank_name" id="bank_name" class="mt-2 block w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                        <option value="">-- Pilih Bank --</option>
                        @foreach(['bca' => 'BCA', 'mandiri' => 'Mandiri', 'bni' => 'BNI', 'bri' => 'BRI', 'gopay' => 'GoPay', 'ovo' => 'OVO'] as $code => $name)
                            <option value="{{ $code }}" @selected(old('bank_name') == $code)>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('bank_name') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="bank_account_number" class="block text-sm font-medium text-deep-navy">Nomor Rekening</label>
                    <input type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number') }}" placeholder="Contoh: 1234567890" class="mt-2 block w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-primary-blue sm:text-sm shadow-sm">
                    @error('bank_account_number') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="rounded-xl bg-primary-blue px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-deep-navy transition-colors">
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>
@endsection
