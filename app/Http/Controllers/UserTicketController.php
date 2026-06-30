<?php

namespace App\Http\Controllers;

use App\Models\BootcampRegistration;
use Illuminate\Http\Request;

class UserTicketController extends Controller
{
    /**
     * Tampilkan daftar riwayat pendaftaran bootcamp (Tiket).
     */
    public function index()
    {
        $tickets = BootcampRegistration::with(['bootcamp'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.tickets.index', compact('tickets'));
    }

    /**
     * Tampilkan detail E-Ticket untuk bootcamp yang sudah berhasil dibayar/gratis.
     */
    public function show($id)
    {
        $ticket = BootcampRegistration::with(['bootcamp.creator', 'user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        // Hanya tiket yang berhasil yang bisa dilihat e-ticketnya
        if ($ticket->status !== 'success') {
            return redirect()->route('user.tickets.index')
                ->with('error', 'E-Ticket belum tersedia. Pastikan status pembayaran Anda sudah Berhasil.');
        }

        return view('user.tickets.show', compact('ticket'));
    }
}
