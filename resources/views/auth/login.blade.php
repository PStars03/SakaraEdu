@extends('layouts.guest')

@section('title', 'Login - SakaraEdu')
@section('header', 'Masuk ke Akun Anda')

@section('content')
    <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="rounded-xl bg-red-50 p-4 mb-4">
                <div class="flex">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul role="list" class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-deep-navy">Alamat Email</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" class="block w-full rounded-xl border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6">
            </div>
        </div>

        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-medium leading-6 text-deep-navy">Password</label>
            <div class="relative mt-2">
                <input id="password" name="password" x-bind:type="show ? 'text' : 'password'" autocomplete="current-password" required class="block w-full rounded-xl border-0 py-2.5 pl-4 pr-10 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-blue sm:text-sm sm:leading-6">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-primary-blue focus:outline-none transition-colors">
                    <!-- Eye outline icon (show) -->
                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <!-- Eye off outline icon (hide) -->
                    <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary-blue focus:ring-primary-blue">
                <label for="remember" class="ml-3 block text-sm leading-6 text-slate-text">Ingat saya</label>
            </div>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-xl bg-primary-blue px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-deep-navy transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-blue">
                Masuk
            </button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-slate-text">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold leading-6 text-primary-blue hover:text-sky-blue">Daftar sekarang</a>
    </p>
@endsection
