<?php

namespace App\Http\Controllers;

use App\Models\DailyTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions with filters.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->dailyTransactions()->latest();

        $filter = $request->input('filter', 'all');

        if ($filter === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter === 'week') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        }

        $transactions = $query->paginate(20)->appends(['filter' => $filter]);
        
        $totalPemasukan = $query->clone()->where('transaction_type', 'masuk')->sum('amount');
        $totalPengeluaran = $query->clone()->where('transaction_type', 'keluar')->sum('amount');

        return view('transactions.index', compact('transactions', 'filter', 'totalPemasukan', 'totalPengeluaran'));
    }

    /**
     * Update the specified transaction.
     */
    public function update(Request $request, $id)
    {
        $transaction = auth()->user()->dailyTransactions()->findOrFail($id);

        $validated = $request->validate([
            'transaction_type' => 'required|in:masuk,keluar',
            'amount'           => 'required|numeric|min:0',
            'category'         => 'required|string|max:50',
            'description'      => 'nullable|string|max:255',
        ]);

        $transaction->update($validated);

        return back()->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy($id)
    {
        $transaction = auth()->user()->dailyTransactions()->findOrFail($id);
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Export the filtered transactions to CSV (Excel compatible).
     */
    public function export(Request $request)
    {
        $query = auth()->user()->dailyTransactions()->latest();

        $filter = $request->input('filter', 'all');

        if ($filter === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter === 'week') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        }

        $transactions = $query->get();

        $filename = "transaksi_sakaraedu_" . $filter . "_" . date('Y-m-d') . ".csv";
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['Tanggal', 'Tipe', 'Kategori', 'Nominal', 'Deskripsi (Prompt)'];

        $callback = function() use($transactions, $columns) {
            $file = fopen('php://output', 'w');
            // Add BOM for proper UTF-8 Excel support
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns);

            foreach ($transactions as $transaction) {
                $row['Tanggal']  = $transaction->created_at->format('Y-m-d H:i');
                $row['Tipe']    = ucfirst($transaction->transaction_type);
                $row['Kategori']  = $transaction->category;
                $row['Nominal'] = $transaction->amount;
                $row['Deskripsi']  = $transaction->description;

                fputcsv($file, array($row['Tanggal'], $row['Tipe'], $row['Kategori'], $row['Nominal'], $row['Deskripsi']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
