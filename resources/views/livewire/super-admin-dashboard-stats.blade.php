<div wire:poll.10s>
    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex flex-col justify-center gap-2 relative overflow-hidden group hover:border-primary-blue/30 transition-colors">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-deep-navy/10 p-3">
                    <svg class="h-5 w-5 text-deep-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Admin</p>
            </div>
            <p class="text-3xl font-bold text-deep-navy pl-1">{{ $adminCount }}</p>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex flex-col justify-center gap-2 relative overflow-hidden group hover:border-green-500/30 transition-colors">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-green-100 p-3">
                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">User Online</p>
            </div>
            <div class="flex items-center gap-2 pl-1">
                <p class="text-3xl font-bold text-deep-navy">{{ $onlineCount }}</p>
                <span class="flex h-2 w-2 rounded-full bg-green-500 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                </span>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex flex-col justify-center gap-2 relative overflow-hidden group hover:border-primary-blue/30 transition-colors">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-primary-blue/10 p-3">
                    <svg class="h-5 w-5 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Beasiswa</p>
            </div>
            <p class="text-3xl font-bold text-deep-navy pl-1">{{ $scholarshipCount }}</p>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex flex-col justify-center gap-2 relative overflow-hidden group hover:border-fresh-green/30 transition-colors">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-fresh-green/10 p-3">
                    <svg class="h-5 w-5 text-fresh-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Bootcamp</p>
            </div>
            <p class="text-3xl font-bold text-deep-navy pl-1">{{ $bootcampCount }}</p>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 flex flex-col justify-center gap-2 relative overflow-hidden group hover:border-sky-blue/30 transition-colors">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-sky-blue/10 p-3">
                    <svg class="h-5 w-5 text-sky-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                </div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Berita</p>
            </div>
            <p class="text-3xl font-bold text-deep-navy pl-1">{{ $newsCount }}</p>
        </div>
    </div>

    <!-- Daftar Pengguna Online -->
    <div class="mt-8 rounded-2xl bg-white shadow-sm border border-slate-100 overflow-hidden">
        <div class="border-b border-slate-100 px-6 py-5 flex items-center gap-3">
            <span class="flex h-3 w-3 rounded-full bg-green-500 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            </span>
            <h3 class="font-heading text-lg font-semibold text-deep-navy">Daftar Pengguna Aktif (Online)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($onlineUsers as $user)
                        <tr wire:key="online-user-{{ $user->id }}" class="hover:bg-slate-50 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-primary-blue/10 flex items-center justify-center text-primary-blue font-bold text-xs uppercase">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-deep-navy">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-sm text-slate-600">{{ $user->email }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-xs font-medium text-green-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Online
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500">
                                Saat ini tidak ada user atau admin yang sedang online.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
