@extends('layouts.dashboard')

@section('title', 'Riwayat Transaksi')
@section('header', 'Riwayat Transaksi')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <a href="{{ route('user.dashboard') }}" class="text-sm font-medium text-slate-500 hover:text-primary-blue transition-colors mb-2 inline-block">
                ← Kembali ke Dashboard
            </a>
            <h2 class="font-heading text-2xl font-bold text-deep-navy">Riwayat Transaksi</h2>
            <p class="text-sm text-slate-500">Kelola riwayat QuickLog AI Anda</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('transactions.export', ['filter' => $filter]) }}" class="inline-flex items-center gap-2 rounded-xl bg-fresh-green px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-600 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Export Excel (CSV)
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 flex items-center gap-3">
            <svg class="h-5 w-5 text-green-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Filters & Summary -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-2 flex space-x-1">
            <a href="{{ route('transactions.index', ['filter' => 'all']) }}" class="flex-1 text-center py-2.5 text-sm font-semibold rounded-xl transition-colors {{ $filter === 'all' ? 'bg-primary-blue text-white shadow-sm' : 'text-slate-500 hover:text-deep-navy hover:bg-slate-50' }}">Semua Waktu</a>
            <a href="{{ route('transactions.index', ['filter' => 'today']) }}" class="flex-1 text-center py-2.5 text-sm font-semibold rounded-xl transition-colors {{ $filter === 'today' ? 'bg-primary-blue text-white shadow-sm' : 'text-slate-500 hover:text-deep-navy hover:bg-slate-50' }}">Hari Ini</a>
            <a href="{{ route('transactions.index', ['filter' => 'week']) }}" class="flex-1 text-center py-2.5 text-sm font-semibold rounded-xl transition-colors {{ $filter === 'week' ? 'bg-primary-blue text-white shadow-sm' : 'text-slate-500 hover:text-deep-navy hover:bg-slate-50' }}">Minggu Ini</a>
            <a href="{{ route('transactions.index', ['filter' => 'month']) }}" class="flex-1 text-center py-2.5 text-sm font-semibold rounded-xl transition-colors {{ $filter === 'month' ? 'bg-primary-blue text-white shadow-sm' : 'text-slate-500 hover:text-deep-navy hover:bg-slate-50' }}">Bulan Ini</a>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Pemasukan</p>
            <p class="text-lg font-bold text-green-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Pengeluaran</p>
            <p class="text-lg font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe</th>
                        <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nominal</th>
                        <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi (Prompt)</th>
                        <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $tx)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-sm text-slate-600 whitespace-nowrap">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $tx->transaction_type === 'masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($tx->transaction_type) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm font-medium text-slate-800 whitespace-nowrap">{{ $tx->category }}</td>
                            <td class="py-4 px-6 text-sm font-bold {{ $tx->transaction_type === 'masuk' ? 'text-green-600' : 'text-red-600' }} whitespace-nowrap">
                                Rp {{ number_format($tx->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-500 truncate max-w-xs" title="{{ $tx->description }}">
                                {{ $tx->description ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openEditModal({{ $tx->id }}, '{{ $tx->transaction_type }}', '{{ addslashes($tx->category) }}', {{ $tx->amount }}, '{{ addslashes($tx->description) }}')" class="p-1.5 text-slate-400 hover:text-primary-blue hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <form action="{{ route('transactions.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-500">
                                Belum ada riwayat transaksi untuk filter ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $transactions->links() }}
        </div>
    </div>

    @push('modals')
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeEditModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform flex flex-col max-h-[90vh] overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-100">
                    
                    <!-- Decorative Header Background -->
                    <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-primary-blue to-deep-navy opacity-10"></div>
                    
                    <form id="editForm" method="POST" action="" class="flex flex-col h-full overflow-hidden">
                        @csrf
                        @method('PUT')
                        
                        <!-- Scrollable Content Area -->
                        <div class="bg-white px-6 pb-6 pt-8 relative z-10 overflow-y-auto flex-1">
                            <!-- Icon Header -->
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-primary-blue to-deep-navy shadow-lg shadow-primary-blue/30 mb-4">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            
                            <div class="text-center">
                                <h3 class="text-xl font-bold leading-6 text-deep-navy mb-1" id="modal-title">Edit Transaksi</h3>
                                <p class="text-sm text-slate-500 mb-6">Koreksi detail transaksi ini jika ada kesalahan pengenalan AI.</p>
                            </div>
                            
                            <div class="space-y-4 text-left">
                                <!-- Tipe Transaksi -->
                                <div class="relative">
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tipe Transaksi</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                                        </div>
                                        <select id="edit_type" name="transaction_type" class="block w-full pl-10 pr-10 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-primary-blue focus:border-primary-blue focus:bg-white transition-colors appearance-none" required>
                                            <option value="masuk">Pemasukan (Masuk)</option>
                                            <option value="keluar">Pengeluaran (Keluar)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kategori & Nominal Row -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Kategori -->
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kategori</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                            </div>
                                            <input type="text" id="edit_category" name="category" required class="block w-full pl-10 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-primary-blue focus:border-primary-blue focus:bg-white transition-colors" placeholder="Kategori">
                                        </div>
                                    </div>

                                    <!-- Nominal -->
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nominal</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-slate-500 sm:text-sm font-medium">Rp</span>
                                            </div>
                                            <input type="number" id="edit_amount" name="amount" min="0" required class="block w-full pl-10 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-primary-blue focus:border-primary-blue focus:bg-white transition-colors" placeholder="0">
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Catatan / Deskripsi</label>
                                    <div class="relative">
                                        <div class="absolute top-2.5 left-3 flex items-start pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </div>
                                        <textarea id="edit_description" name="description" rows="2" class="block w-full pl-10 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-primary-blue focus:border-primary-blue focus:bg-white transition-colors resize-none" placeholder="Tuliskan catatan transaksi..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sticky Footer Actions -->
                        <div class="bg-slate-50 px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3 border-t border-slate-100 flex-shrink-0 rounded-b-3xl">
                            <button type="button" onclick="closeEditModal()" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm border border-slate-200 hover:bg-slate-50 hover:text-deep-navy transition-all mt-3 sm:mt-0">Batal</button>
                            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-primary-blue px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-primary-blue/20 hover:bg-deep-navy hover:shadow-lg transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endpush

    <!-- Scripts -->
    <script>
        function openEditModal(id, type, category, amount, description) {
            // Set form action dynamically
            document.getElementById('editForm').action = '/transactions/' + id;
            
            // Populate fields
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_amount').value = amount;
            document.getElementById('edit_description').value = description;

            // Show modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            // Hide modal
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
@endsection
