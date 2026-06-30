<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
    public function index()
    {
        return view('bootcamps.index');
    }

    public function show($slug)
    {
        $bootcamp = Bootcamp::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('bootcamps.show', compact('bootcamp'));
    }

    public function checkout($slug)
    {
        $bootcamp = Bootcamp::where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        // Cek apakah user sudah daftar
        $existingRegistration = \App\Models\BootcampRegistration::where('user_id', auth()->id())
            ->where('bootcamp_id', $bootcamp->id)
            ->whereIn('status', ['pending', 'success'])
            ->first();

        if ($existingRegistration) {
            if ($existingRegistration->status == 'success') {
                return redirect()->route('bootcamps.show', $slug)->with('error', 'Anda sudah mendaftar bootcamp ini.');
            }
            $registration = $existingRegistration;
        } else {
            // Buat pendaftaran baru
            $registration = \App\Models\BootcampRegistration::create([
                'user_id' => auth()->id(),
                'bootcamp_id' => $bootcamp->id,
                'order_id' => 'BTR-' . time() . '-' . auth()->id(),
                'amount' => $bootcamp->is_paid ? $bootcamp->price : 0,
                'status' => 'pending',
            ]);
        }

        // Jika gratis, langsung sukses
        if (!$bootcamp->is_paid) {
            $registration->update(['status' => 'success']);
            return redirect()->route('bootcamps.show', $slug)->with('success', 'Pendaftaran berhasil!');
        }

        // Generate Snap Token jika belum ada atau order id expired
        if (!$registration->snap_token) {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $registration->order_id,
                    'gross_amount' => (int) $registration->amount,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                'item_details' => [
                    [
                        'id' => 'BTC-' . $bootcamp->id,
                        'price' => (int) $registration->amount,
                        'quantity' => 1,
                        'name' => substr($bootcamp->title, 0, 50),
                    ]
                ]
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $registration->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                return redirect()->route('bootcamps.show', $slug)->with('error', 'Gagal memproses pembayaran. Pastikan API Midtrans sudah diatur dengan benar.');
            }
        }

        return view('bootcamps.checkout', compact('bootcamp', 'registration'));
    }
}
