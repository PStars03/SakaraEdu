<?php

namespace App\Http\Controllers;

use App\Models\BootcampRegistration;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            $transaction = BootcampRegistration::where('order_id', $request->order_id)->first();
            
            if ($transaction) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $transaction->update(['status' => 'success']);
                } else if ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel' || $request->transaction_status == 'deny') {
                    $transaction->update(['status' => 'failed']);
                } else if ($request->transaction_status == 'pending') {
                    $transaction->update(['status' => 'pending']);
                }
            }
        }
        
        return response()->json(['message' => 'Callback received']);
    }
}
