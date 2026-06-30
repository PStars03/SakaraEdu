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
        
        $registration = \App\Models\BootcampRegistration::where('user_id', auth()->id())
            ->where('bootcamp_id', $bootcamp->id)
            ->whereIn('status', ['pending', 'success'])
            ->first();

        if ($registration && $registration->status == 'success') {
            return redirect()->route('bootcamps.show', $slug)->with('error', 'Anda sudah mendaftar bootcamp ini.');
        }

        return view('bootcamps.checkout', compact('bootcamp', 'registration'));
    }

    public function processCheckout(Request $request, $slug)
    {
        $bootcamp = Bootcamp::where('slug', $slug)->where('status', 'published')->firstOrFail();

        $request->validate([
            'method' => 'required|in:bca,mandiri,bni,gopay,ovo,qris',
            'ovo_phone' => 'required_if:method,ovo',
        ]);

        $orderId = 'BTR-' . time() . '-' . auth()->id();
        $amount = $bootcamp->is_paid ? $bootcamp->price + 5000 : 0; // + service fee

        $registration = \App\Models\BootcampRegistration::create([
            'user_id' => auth()->id(),
            'bootcamp_id' => $bootcamp->id,
            'order_id' => $orderId,
            'amount' => $amount,
            'status' => $bootcamp->is_paid ? 'pending' : 'success',
            'payment_method' => $request->method,
        ]);

        if (!$bootcamp->is_paid) {
            return redirect()->route('bootcamps.show', $slug)->with('success', 'Pendaftaran berhasil!');
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => 'BTC-' . $bootcamp->id,
                    'price' => (int) $amount,
                    'quantity' => 1,
                    'name' => substr($bootcamp->title, 0, 50),
                ]
            ]
        ];

        switch ($request->method) {
            case 'bca':
            case 'bni':
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = ['bank' => $request->method];
                break;
            case 'mandiri':
                $params['payment_type'] = 'echannel';
                $params['echannel'] = [
                    'bill_info1' => 'Payment',
                    'bill_info2' => 'Online'
                ];
                break;
            case 'gopay':
                $params['payment_type'] = 'gopay';
                break;
            case 'ovo':
                $params['payment_type'] = 'ovo';
                $params['ovo'] = ['phone' => $request->ovo_phone];
                break;
            case 'qris':
                $params['payment_type'] = 'qris';
                break;
        }

        try {
            $response = \Midtrans\CoreApi::charge($params);
            $registration->update([
                'payment_info' => (array) $response
            ]);

            return redirect()->route('bootcamps.payment', ['slug' => $slug, 'order_id' => $orderId]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem pembayaran: ' . $e->getMessage());
        }
    }

    public function payment($slug, $order_id)
    {
        $bootcamp = Bootcamp::where('slug', $slug)->firstOrFail();
        $registration = \App\Models\BootcampRegistration::where('order_id', $order_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('bootcamps.payment', compact('bootcamp', 'registration'));
    }
}
